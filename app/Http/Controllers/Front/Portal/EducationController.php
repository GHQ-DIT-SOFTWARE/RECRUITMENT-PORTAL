<?php

declare(strict_types=1);

namespace App\Http\Controllers\Front\Portal;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Card;
use App\Models\Course;
use App\Models\BECERESULTS;
use App\Models\BECESUBJECT;
use App\Models\WASSCERESULTS;
use App\Models\WASSCESUBJECT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware('portal');
    }
    public function education_details()
    {
        $serial_number = session('serial_number');
        $pincode = session('pincode');
        $card = Card::where('serial_number', $serial_number)->where('pincode', $pincode)->first();
        $applied_applicant = Applicant::where('card_id', $card->id)->first();
        $bece_results = BECERESULTS::all();
        $bece_subject = BECESUBJECT::all();
        $wassce_subject = WASSCESUBJECT::all();
        $applicant_course = Course::all();
        $all_grades = WASSCERESULTS::pluck('wassceresult')->toArray();

        // Separate WASSCE and SSSCE grades
        $wassce_grades = array_filter($all_grades, function ($grade) {
            return in_array($grade, ['A1', 'B2', 'B3', 'C4', 'C5', 'C6', 'D7', 'E8', 'F9']);
        });

        $sssce_grades = array_filter($all_grades, function ($grade) {
            return in_array($grade, ['A', 'B', 'C', 'D', 'E', 'F']);
        });
        return view('portal.education', compact(
            'wassce_subject',
            'applied_applicant',
            'applicant_course',
            'wassce_grades',
            'sssce_grades',
            'bece_subject',
            'bece_results',
        ));
    }

    public function saveEducationData(Request $request)
    {
        $applicant = Applicant::where('card_id', $request->session()->get('card_id'))->firstOrFail();
        $beceCertificateRule = $applicant->bece_certificate ? 'nullable|file|mimes:pdf|max:1024' : 'required|file|mimes:pdf|max:1024';
        // $wassceCertificateRule = $applicant->wassce_certificate ? 'nullable|file|mimes:pdf|max:1024' : 'required|file|mimes:pdf|max:1024';
        // The parent field
        $wassceCertificateRule = $applicant->wassce_certificate
            ? 'nullable|array'
            : 'required|array';

        // The individual files
        $wassceCertificateItemRule = 'file|mimes:pdf|max:1024';



        $subjects = [

            'bece_subject_three' => $request->bece_subject_three,
            'bece_subject_four' => $request->bece_subject_four,
            'bece_subject_five' => $request->bece_subject_five,
            'bece_subject_six' => $request->bece_subject_six,
            'wassce_subject_three' => $request->wassce_subject_three,
            'wassce_subject_four' => $request->wassce_subject_four,
            'wassce_subject_five' => $request->wassce_subject_five,
            'wassce_subject_six' => $request->wassce_subject_six,
        ];
        // Check for duplicates
        $subjectValues = array_values($subjects);
        $duplicates = array_diff_assoc($subjectValues, array_unique($subjectValues));
        // Collect custom validation errors for duplicate subjects
        $customErrors = [];
        if (count($duplicates) > 0) {
            foreach ($subjects as $field => $value) {
                if (in_array($value, $duplicates)) {
                    $customErrors[$field] = 'This subject is duplicated. Please choose a different subject.';
                }
            }
        }
        // Combine custom validation with normal validation
        $validator = Validator::make($request->all(), [
            'bece_index_number' => 'required|digits:10',
            'wassce_index_number' => 'required|digits:10',
            'wassce_subject_english_grade' => 'required',
            'wassce_subject_maths_grade' => 'required',
            'wassce_english' => 'required',
            'bece_english' => 'required',
            'bece_mathematics' => 'required',
            'bece_subject_maths_grade' => 'required',
            'wassce_mathematics' => 'required',
            'wassce_subject_three' => 'required',
            'wassce_subject_four' => 'required',
            'wassce_subject_five' => 'required',
            'wassce_subject_six' => 'required',
            'wassce_certificate' => $wassceCertificateRule,
            'wassce_certificate.*' => $wassceCertificateItemRule,
            'wassce_subject_three_grade' => 'required',
            'exam_type_one' => 'required',
            'exam_type_two' => 'required',
            'exam_type_three' => 'required',
            'exam_type_four' => 'required',
            'exam_type_five' => 'required',
            'exam_type_six' => 'required',
            'results_slip_one' => 'required',
            'results_slip_two' => 'required',
            'results_slip_three' => 'required',
            'results_slip_four' => 'required',
            'results_slip_five' => 'required',
            'results_slip_six' => 'required',
            'wassce_subject_three_grade' => 'required',
            'wassce_subject_four_grade' => 'required',
            'wassce_subject_five_grade' => 'required',
            'wassce_subject_six_grade' => 'required',
            'name_of_secondary_school' => 'required',
            'wassce_year_completion' => 'required',
            'secondary_course_offered' => 'required',
            'wassce_serial_number' => 'required',

            'bece_subject_three' => 'required|different:bece_subject_four,bece_subject_five,bece_subject_six',
            'bece_subject_four' => 'required|different:bece_subject_three,bece_subject_five,bece_subject_six',
            'bece_subject_five' => 'required|different:bece_subject_three,bece_subject_four,bece_subject_six',
            'bece_subject_six' => 'required|different:bece_subject_three,bece_subject_four,bece_subject_five',
            'bece_subject_three_grade' => 'required',
            'bece_subject_four_grade' => 'required',
            'bece_subject_five_grade' => 'required',
            'bece_subject_six_grade' => 'required',
            'bece_subject_maths_grade' => 'required',
            'bece_subject_english_grade' => 'required',
            'bece_subject_maths_grade' => 'required',
            'bece_subject_english_grade' => 'required',
            'bece_subject_maths_grade' => 'required',
            'bece_subject_english_grade' => 'required',
        ]);
        // Merge custom errors into the validator
        if (!empty($customErrors)) {
            foreach ($customErrors as $field => $message) {
                $validator->errors()->add($field, $message);
            }
        }
        // Redirect back with errors if validation fails
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $wassce_files_array = [];
        if ($request->hasFile('wassce_certificate')) {
            foreach ($request->file('wassce_certificate') as $file) {
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $name_gen = $originalName . '-' . time() . '.' . $extension;

                // Save to "public/uploads/shscertificate"
                $file->move(public_path('uploads/shscertificate'), $name_gen);

                // Save clean path (without duplicated slashes)
                $wassce_files_array[] = 'uploads/shscertificate/' . $name_gen;
            }
        }

        // Final assignment
        $wassce_files_for_db = !empty($wassce_files_array)
            ? json_encode($wassce_files_array)
            : $applicant->wassce_certificate;


        // $wassce_save_url = $applicant->wassce_certificate;
        // if ($request->hasFile('wassce_certificate')) {
        //     $file = $request->file('wassce_certificate');
        //     // Use the original file name and sanitize it
        //     $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //     $extension = $file->getClientOriginalExtension();
        //     $name_gen = $originalName . '.' . $extension;
        //     $file->move(public_path('uploads/shscertificate'), $name_gen);
        //     $wassce_save_url = 'uploads/shscertificate/' . $name_gen;
        // }



        $bece_save_url = $applicant->bece_certificate;
        if ($request->hasFile('bece_certificate')) {
            $file = $request->file('bece_certificate');
            // Use the original file name and sanitize it
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $name_gen = $originalName . '-' . time() . '.' . $extension;
            $file->move(public_path('uploads/jhscertficate'), $name_gen);
            $bece_save_url = 'uploads/jhscertficate/' . $name_gen;
        }

        $applicant->update([
            'bece_index_number' => $request->bece_index_number,
            'bece_year_completion' => $request->bece_year_completion,
            'wassce_index_number' => $request->wassce_index_number,
            'wassce_year_completion' => $request->wassce_year_completion,
            'wassce_serial_number' => $request->wassce_serial_number,
            'secondary_course_offered' => $request->secondary_course_offered,
            'name_of_secondary_school' => $request->name_of_secondary_school,
            'bece_certificate' => $bece_save_url,
            // BECE grades
            'bece_english' => $request->bece_english,
            'bece_subject_english_grade' => $request->bece_subject_english_grade,
            'bece_mathematics' => $request->bece_mathematics,
            'bece_subject_maths_grade' => $request->bece_subject_maths_grade,
            'bece_subject_three' => $request->bece_subject_three,
            'bece_subject_three_grade' => $request->bece_subject_three_grade,
            'bece_subject_four' => $request->bece_subject_four,
            'bece_subject_four_grade' => $request->bece_subject_four_grade,
            'bece_subject_five' => $request->bece_subject_five,
            'bece_subject_five_grade' => $request->bece_subject_five_grade,
            'bece_subject_six' => $request->bece_subject_six,
            'bece_subject_six_grade' => $request->bece_subject_six_grade,
            //
            'wassce_index_number' => $request->wassce_index_number,
            'wassce_year_completion' => $request->wassce_year_completion,
            'wassce_serial_number' => $request->wassce_serial_number,
            'secondary_course_offered' => $request->secondary_course_offered,
            'name_of_secondary_school' => $request->name_of_secondary_school,
            // WASSCE grades
            'wassce_english' => $request->wassce_english,
            'wassce_subject_english_grade' => $request->wassce_subject_english_grade,
            'wassce_mathematics' => $request->wassce_mathematics,
            'wassce_subject_maths_grade' => $request->wassce_subject_maths_grade,
            'wassce_subject_three' => $request->wassce_subject_three,
            'wassce_subject_three_grade' => $request->wassce_subject_three_grade,
            'wassce_subject_four' => $request->wassce_subject_four,
            'wassce_subject_four_grade' => $request->wassce_subject_four_grade,
            'wassce_subject_five' => $request->wassce_subject_five,
            'wassce_subject_five_grade' => $request->wassce_subject_five_grade,
            'wassce_subject_six' => $request->wassce_subject_six,
            'wassce_subject_six_grade' => $request->wassce_subject_six_grade,
            'wassce_certificate' => $wassce_files_for_db,
            // 'wassce_certificate' => $wassce_save_url,
            'exam_type_one' => $request->exam_type_one,
            'exam_type_two' => $request->exam_type_two,
            'exam_type_three' => $request->exam_type_three,
            'exam_type_four' => $request->exam_type_four,
            'exam_type_five' => $request->exam_type_five,
            'exam_type_six' => $request->exam_type_six,
            'results_slip_one' => $request->results_slip_one,
            'results_slip_two' => $request->results_slip_two,
            'results_slip_three' => $request->results_slip_three,
            'results_slip_four' => $request->results_slip_four,
            'results_slip_five' => $request->results_slip_five,
            'results_slip_six' => $request->results_slip_six,


        ]);
        return redirect()->route('preview');
    }

    public function getSubjectsByCourse(Request $request)
    {
        $course = $request->get('course');

        $subjects = WASSCESUBJECT::where('main_course', $course)->get(['wasscesubjects']);

        return response()->json($subjects);
    }
}
