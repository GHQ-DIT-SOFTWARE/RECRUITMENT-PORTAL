<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front\Portal;

use App\Http\Controllers\Controller;
use App\Models\AgeLimit;
use App\Models\Applicant;
use App\Models\Branch;
use App\Models\Card;
use App\Models\User;
use App\Notifications\ApplicantAppliedNotification;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class AcceptanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('portal');
    }

    public function preview()
    {
        $serial_number = session('serial_number');
        $card = Card::where('serial_number', $serial_number)->first();
        $applied_applicant = Applicant::where('card_id', $card->id)->first();
        return view('portal.preview', compact('applied_applicant'));
    }



    public function Declaration_and_Acceptance(Request $request)
    {
        $request->validate([
            'final_checked' => 'required|in:YES',
        ]);
        $applicant = Applicant::where('card_id', $request->session()->get('card_id'))->firstOrFail();
        $disqualificationReasons = [];
        $nationalIdExists = DB::table('applicants')
            ->where('national_identity_card', $applicant->national_identity_card)
            ->where('id', '<>', $applicant->id)
            ->exists();
        // Check for duplicate WASSCE index or National ID
        $WassceExists = DB::table('applicants')
            ->where('wassce_index_number', $applicant->wassce_index_number)
            ->where('id', '<>', $applicant->id)
            ->exists();
        if ($nationalIdExists || $WassceExists) {
            $applicant->duplicate_entry = 'DUPLICATED INFO';
            $applicant->save(); // Ensure this is saved!
            $applicant->load('card');
            if ($applicant->card) {
                $applicant->card->status = 1;
                $applicant->card->save();
            }
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return response()->json([
                'status' => 'duplicate',
                'message' => 'Your information already exists in the portal.',
                'redirect_url' => route('applicant.already-exists')
            ]);
        }
        $applicant->final_checked = 'YES';
        $applicant->qualification = 'QUALIFIED';
        $applicant->disqualification_reason = null;
        $year = Carbon::now()->format('y');

        $randomString = Str::random(7);
        $year = now()->format('y');

        // Check arm of service
        $armIndicator = $this->getArmIndicator($applicant->arm_of_service);
        if (!$armIndicator) {
            throw new \Exception("Invalid arm of service: {$applicant->arm_of_service}");
        }

        // Check branch relationship
        if (!$applicant->branches || !$applicant->branches->branch) {
            throw new \Exception("Invalid or missing branch. Applicant ID: {$applicant->id}, Branch ID: {$applicant->branch_id}");
        }

        $branch = $applicant->branches->branch;
        $branchCode = $this->generateBranchCode($branch);
        if (!$branchCode) {
            throw new \Exception("Branch code could not be generated from: $branch");
        }

        // Safe strtoupper
        $applicantSerialNumber = strtoupper($randomString . $year . $armIndicator . $branchCode);

        // Save
        $applicant->card->applicant_serial_number = $applicantSerialNumber;
        $applicant->card->save();

        // Calculate and store age
        $latestAgeLimitDate = AgeLimit::where('trade_type', $applicant->trade_type)
            ->orderBy('agelimit_date', 'desc')
            ->value('agelimit_date');
        if (!$latestAgeLimitDate) {
            $disqualificationReasons[] = 'No age limit date found for your commission type.';
        } else {
            $ageAtDeadline = Carbon::parse($applicant->date_of_birth)->diffInYears(Carbon::parse($latestAgeLimitDate));
            $exactAgeAtDeadline = Carbon::parse($applicant->date_of_birth)->diff(Carbon::parse($latestAgeLimitDate));
            $applicant->age = $ageAtDeadline;
            $applicant->save();
        }
        // Qualification Rules
        $this->checkExamResults($applicant, $disqualificationReasons);
        // $this->checkResults($applicant, $disqualificationReasons);
        $applicant->applicant_serial_number = $applicantSerialNumber;
        $qrCodePath = $this->generateQrCode($applicant);

        $bmi = $this->calculateBmi($applicant);
        $bmiClassification = $this->classifyBmi($bmi);
        if (in_array($applicant->branches->branch, ['MILITARY POLICE', 'AIRFORCE POLICE'])) {
            $height = number_format((float) $applicant->height, 1);
            if (($applicant->sex === 'MALE' && $height < 5.9) || ($applicant->sex === 'FEMALE' && $height < 5.7)) {
                $disqualificationReasons[] = 'Height requirement minimum 5.9 feet for males and 5.7 feet for females.';
            }
        }

        // if ($applicant->branches->branch === 'MILITARY POLICE') {
        //     $height = number_format((float) $applicant->height, 1);
        //     if (($applicant->sex === 'MALE' && $height < 5.9) || ($applicant->sex === 'FEMALE' && $height < 5.7)) {
        //         $disqualificationReasons[] = 'Height requirement minimum 5.9 feet for males and 5.7 feet for females.';
        //     }
        // }


        if (isset($applicant->height)) {
            $height = number_format((float) $applicant->height, 1);
            if (($applicant->sex === 'MALE' && $height < 5.6) || ($applicant->sex === 'FEMALE' && $height < 5.2)) {
                $disqualificationReasons[] = 'Height requirement minimum 5.6 feet for males and 5.2 feet for females.';
            }
        }
        if (isset($ageAtDeadline)) {
            if ($applicant->trade_type === 'TRADESMEN') {
                if ($ageAtDeadline < 18 || $ageAtDeadline > 27) {
                    $disqualificationReasons[] = 'Your age as of the deadline was ' . $exactAgeAtDeadline->y . ' years, ' . $exactAgeAtDeadline->m . ' months, and ' . $exactAgeAtDeadline->d . ' days. TRADESMEN age limit is 18–27.';
                }
            } elseif ($applicant->trade_type === 'NON-TRADESMEN') {
                if ($ageAtDeadline < 18 || $ageAtDeadline > 25) {
                    $disqualificationReasons[] = 'Your age as of the deadline was ' . $exactAgeAtDeadline->y . ' years, ' . $exactAgeAtDeadline->m . ' months, and ' . $exactAgeAtDeadline->d . ' days. NON-TRADESMEN age limit is 18–25.';
                }
            }
        }

        if ($applicant->marital_status === 'MARRIED') {
            $disqualificationReasons[] = 'Married applicants are disqualified.';
        }
        if ($bmi >= 25) {
            $disqualificationReasons[] = 'Applicant is classified as ' . $bmiClassification . ' with a BMI of ' . number_format($bmi, 2) . '. This classification disqualifies you from proceeding.';
        }
        // Exam type mixing
        $examTypes = [
            'exam_type_one',
            'exam_type_two',
            'exam_type_three',
            'exam_type_four',
            'exam_type_five',
            'exam_type_six',
        ];

        $examTypesList = array_filter(array_map(fn($type) => $applicant->$type, $examTypes));
        $examCounts = array_count_values($examTypesList);

        if (!empty($examCounts['SSSCE']) && !empty($examCounts['WASSCE'])) {
            $disqualificationReasons[] = 'A combination of SSSCE and WASSCE results is not acceptable.';
        }
        // Final Disqualification Check
        if (!empty($disqualificationReasons)) {
            return $this->disqualifyAndSave($disqualificationReasons, $applicant);
        }
        // Only Qualified Applicants reach here
        $applicant->load('card');
        $applicant->card->status = 1;
        $applicant->card->save(); // ← add this line
        $applicantSerialNumber = null;
        $pdfUrl = route('applicant-pdf');
        $admins = User::where('is_admin', 1)->get();
        Notification::send($admins, new ApplicantAppliedNotification($applicant));
        $this->sendQualificationSmsToApplicant($applicant, $applicantSerialNumber);
        $this->generateApplicantSummaryPdf($applicant);
        // $this->sendQualificationSmsToApplicant($applicant, $applicantSerialNumber);
        $applicant->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Applicant is qualified.',
            'pdf_url' => $pdfUrl,
        ]);
    }



    public function generateQrCode($applicant)
    {
        // Define the path to save the QR code image
        $qrCodePath = 'uploads/qrcodes/' . $applicant->applicant_serial_number . '.png';
        $fullPath = public_path($qrCodePath);

        // The actual data to encode (e.g., the route/UUID)
        $plainText = 'applicant/' . $applicant->uuid;

        // Your encryption key
        $encryptionKey = 'GHQP@$$WORD@$%';

        // Encrypt using AES-256-CBC
        $iv = random_bytes(16); // Initialization vector
        $encrypted = openssl_encrypt($plainText, 'AES-256-CBC', $encryptionKey, OPENSSL_RAW_DATA, $iv);

        // Combine IV and encrypted data then encode to base64
        $encryptedPayload = base64_encode($iv . $encrypted);

        // Generate QR code with the encrypted payload
        $qrCode = new QrCode($encryptedPayload);
        $qrCode->setSize(300);

        // Save QR code image
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        file_put_contents($fullPath, $result->getString());

        // Store the path
        $applicant->qr_code_path = $qrCodePath;
        $applicant->save();

        return $qrCodePath;
    }


    protected function sendQualificationSmsToApplicant($applicant, $applicantSerialNumber)
    {
        if ($applicant->qualification === 'QUALIFIED') {
            $this->sendQualificationSms($applicant, 'Your Application has been received. We are reviewing it and will notify you if you pass the checks. Thank you.');
        }
        // Don't send disqualified SMS here; it's already sent in disqualifyAndSave()
    }


    protected function disqualifyAndSave($reasons, $applicant)
    {
        $applicant->qualification = 'DISQUALIFIED';
        $applicant->disqualification_reason = implode('; ', $reasons);
        // Load the card relationship
        $applicant->load('card');
        if ($applicant->card) {
            $applicant->card->status = 1; // Set card status to 1 for Disqualified
            $applicant->card->save(); // Save the card status update
        }
        $applicant->save(); // Save applicant data
        $pdfUrl = route('applicant-pdf'); // Generate PDF URL
        $admins = User::where('is_admin', 1)->get();
        Notification::send($admins, new ApplicantAppliedNotification($applicant));
        // Send SMS for disqualification
        $this->sendQualificationSms($applicant, 'Unfortunately, you have been DISQUALIFIED. Reason: ' . $applicant->disqualification_reason);
        $this->generateApplicantSummaryPdf($applicant);
        return response()->json([
            'status' => 'error',
            'message' => 'Applicant has been disqualified.',
            'pdf_url' => $pdfUrl,
        ]);
    }

    public function generateApplicantSummaryPdf(Applicant $applicant)
    {
        $applicant->load('card', 'branches');

        $pdf = Pdf::loadView('portal.pdf.applicant_summary', [
            'applied_applicant' => $applicant
        ]);

        // Generate file name using surname and serial number
        $safeSurname = preg_replace('/[^A-Za-z0-9_\-]/', '_', $applicant->surname); // sanitize filename
        $serialNumber = $applicant->applicant_serial_number ?? $applicant->card->applicant_serial_number ?? 'unknown';

        $fileName = $safeSurname . '_' . $serialNumber . '.pdf';
        $filePath = public_path('uploads/pdfs/' . $fileName);

        // Ensure directory exists
        File::ensureDirectoryExists(public_path('uploads/pdfs'));

        $pdf->save($filePath);

        // Save path in DB if needed
        $applicant->pdf_path = 'uploads/pdfs/' . $fileName;
        $applicant->save();
    }



    // public function generateApplicantSummaryPdf(Applicant $applicant)
    // {
    //     $applicant->load('card', 'branches');

    //     $pdf = Pdf::loadView('portal.pdf.applicant_summary', [
    //         'applied_applicant' => $applicant
    //     ]);

    //     $fileName = $applicant->uuid . '.pdf';
    //     $filePath = public_path('uploads/pdfs/' . $fileName);

    //     // Ensure directory exists
    //     File::ensureDirectoryExists(public_path('uploads/pdfs'));

    //     $pdf->save($filePath);

    //     // Optional: Save PDF path in DB if needed
    //     $applicant->pdf_path = 'uploads/pdfs/' . $fileName;
    //     $applicant->save();
    // }


    protected function sendQualificationSms($applicant, $message)
    {
        // Call your SMS sending function here
        send_sms($applicant->contact, $message);
    }

    // protected function checkResults($applicant, array &$disqualificationReasons)
    // {


    //     $gradeMap = [
    //         'A1' => 1,
    //         'B2' => 2,
    //         'B3' => 3,
    //         'C4' => 4,
    //         'C5' => 5,
    //         'C6' => 6,
    //         'D7' => 7,
    //         'E8' => 8,
    //         'F9' => 9,
    //         'A' => 1,
    //         'B' => 2,
    //         'C' => 3,
    //         'D' => 4,
    //         'E' => 8,
    //         'F' => 9,
    //     ];

    //     $grades = [
    //         $applicant->wassce_subject_english_grade,
    //         $applicant->wassce_subject_maths_grade,
    //         $applicant->wassce_subject_three_grade,
    //         $applicant->wassce_subject_four_grade,
    //         $applicant->wassce_subject_five_grade,
    //         $applicant->wassce_subject_six_grade,
    //     ];

    //     $gradeValues = array_map(function ($grade) use ($gradeMap) {
    //         return $gradeMap[$grade] ?? 0; // If grade is invalid/missing, count it as 0
    //     }, $grades);
    // }


    protected function checkExamResults($applicant, &$disqualificationReasons)
    {
        $examTypes = [
            'exam_type_one',
            'exam_type_two',
            'exam_type_three',
            'exam_type_four',
            'exam_type_five',
            'exam_type_six',
        ];
        // Fetch subject names from the database or predefined list
        $subjectMappings = $this->getSubjectMappings($applicant);
        $examSubjects = array_keys($subjectMappings);
        // Track failed subjects to avoid repetition
        $failedSubjects = [];
        foreach ($examTypes as $index => $examType) {
            $examTypeValue = $applicant->{$examType};
            if ($examTypeValue === 'WASSCE' || $examTypeValue === 'PRIVATE') {
                $this->checkWassceAndPrivateGrades($applicant, $subjectMappings, $disqualificationReasons, $failedSubjects);
            } elseif ($examTypeValue === 'SSSCE') {
                $this->checkALevelGrades($applicant, $subjectMappings, $disqualificationReasons, $failedSubjects);
            }
        }
    }

    // Fetch subject mappings from the database or a predefined list
    protected function getSubjectMappings($applicant)
    {
        return [
            'wassce_english_grade' => $applicant->wassce_english,
            'wassce_mathematics_grade' => $applicant->wassce_mathematics,
            'wassce_subject_three_grade' => $applicant->wassce_subject_three,
            'wassce_subject_four_grade' => $applicant->wassce_subject_four,
            'wassce_subject_five_grade' => $applicant->wassce_subject_five,
            'wassce_subject_six_grade' => $applicant->wassce_subject_six,
        ];
    }

    // Method to check WASSCE and PRIVATE exam grades
    protected function checkWassceAndPrivateGrades($applicant, $subjectMappings, &$disqualificationReasons, &$failedSubjects)
    {


        // $failingGrades = ['D7', 'E8', 'F9'];
        // foreach ($subjectMappings as $gradeField => $subjectName) {
        //     $grade = $applicant->{$gradeField};
        //     if (in_array($grade, $failingGrades)) {
        //         $failureMessage = "Failed $subjectName with grade $grade.";
        //         // Add to disqualificationReasons if not already added
        //         if (!in_array($failureMessage, $failedSubjects)) {
        //             $disqualificationReasons[] = $failureMessage;
        //             $failedSubjects[] = $failureMessage;
        //         }
        //     }
        // }

        $isArmy = $applicant->arm_of_service === 'ARMY';

        // Failing grades based on arm
        $failingGrades = $isArmy ? ['E8', 'F9'] : ['D7', 'E8', 'F9'];

        foreach ($subjectMappings as $gradeField => $subjectName) {
            $grade = $applicant->{$gradeField};

            // Skip missing/empty grades
            if (!$grade) {
                Log::warning("Missing grade for '$gradeField' (Applicant ID: {$applicant->id})");
                continue;
            }

            if (in_array($grade, $failingGrades)) {
                $failureMessage = "Failed $subjectName with grade $grade.";

                if (!in_array($failureMessage, $failedSubjects)) {
                    $disqualificationReasons[] = $failureMessage;
                    $failedSubjects[] = $failureMessage;
                }
            }
        }
    }
    // Method to check A LEVEL exam grades
    protected function checkALevelGrades($applicant, $subjectMappings, &$disqualificationReasons, &$failedSubjects)
    {

        $failingGrade = 'E';
        foreach ($subjectMappings as $gradeField => $subjectName) {
            $grade = $applicant->{$gradeField};
            if ($grade === $failingGrade) {
                $failureMessage = "Failed $subjectName with grade $grade.";
                // Add to disqualificationReasons if not already added
                if (!in_array($failureMessage, $failedSubjects)) {
                    $disqualificationReasons[] = $failureMessage;
                    $failedSubjects[] = $failureMessage;
                }
            }
        }
    }


    // Helper method to generate branch code based on branch name
    protected function generateBranchCode($branch)
    {
        $branchWords = explode(' ', strtoupper($branch));
        $branchCode = '';
        if (count($branchWords) > 1) {
            foreach ($branchWords as $word) {
                $branchCode .= $word[0];
            }
        } else {
            $branchCode = substr($branchWords[0], 0, 1);
        }
        return $branchCode;
    }
    // Helper method to generate the arm indicator based on the arm of service
    protected function getArmIndicator($armOfService)
    {
        switch ($armOfService) {
            case 'ARMY':
                return 'X';
            case 'NAVY':
                return 'Y';
            case 'AIRFORCE':
                return 'Z';
            default:
                return '';
        }
    }
    // Helper method to calculate the BMI of the applicant
    protected function calculateBmi($applicant)
    {
        $heightString = (string) $applicant->height;
        $heightParts = explode('.', $heightString);
        $feet = $heightParts[0];
        $inches = isset($heightParts[1]) ? $heightParts[1] : 0;
        $heightInInches = ($feet * 12) + $inches;
        $heightInMeters = $heightInInches * 0.0254;
        $weightInKg = $applicant->weight;
        return $weightInKg / ($heightInMeters * $heightInMeters);
    }

    // Helper method to classify BMI
    protected function classifyBmi($bmi)
    {
        if ($bmi < 18.5) {
            return 'Underweight';
        } elseif ($bmi < 24.9) {
            return 'Normal weight';
        } elseif ($bmi < 29.9) {
            return 'Overweight';
        } else {
            return 'Obese';
        }
    }
}
