<!DOCTYPE html>
<html>
<head>
    <title>Applicant Summary Sheet</title>
    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; line-height: 1.5; }
        .content { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        td, th { padding: 8px; text-align: left; vertical-align: top; }
        .image-border { border: 2px solid #000; border-radius: 4px; }
        .background-gaf {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: url('{{ public_path('GAF.png') }}');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.1;
            z-index: -2;
        }
        .background-stars {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-image: url('{{ public_path('star.jpg') }}');
            background-repeat: repeat;
            background-size: 60px;
            opacity: 0.05;
            z-index: -1;
        }
    </style>

</head>
<body>
<div class="background-gaf"></div>
<div class="background-stars"></div>

<div class="content">
    <table>
        <tr>
            <td><strong>GHANA ARMED FORCES</strong></td>
            <td align="right"><strong>STATUS:</strong> {{ $applied_applicant->qualification }}</td>
        </tr>
        <tr><td><strong>ONLINE RECRUITMENT</strong></td></tr>
        <tr>
            <td colspan="2">
                <strong>APPLIED AT:</strong> {{ \Carbon\Carbon::parse($applied_applicant->created_at)->format('d M, Y h:i A') }}
            </td>
        </tr>
    </table>

    <p align="center"><strong>APPLICATION SUMMARY REPORT</strong></p>

    <table>
        <tr align="center">
            <td>
                @php $imgPath = public_path($applied_applicant->applicant_image); @endphp
                @if (file_exists($imgPath))
                    <img src="{{ $imgPath }}" width="160" height="160" class="image-border">
                @else
                    <img src="{{ public_path('assets/images/img_placeholder_avatar.jpg') }}" width="160" class="image-border">
                @endif
            </td>
        </tr>
    </table>
<table>
    <tr>
        <td>GAF NUMBER: {{ $applied_applicant->applicant_serial_number }}</td>
        <td></td>
    </tr>

      <tr>
        <td>SURNAME:  {{ $applied_applicant->surname }}</td>
        <td>OTHER NAMES: {{ $applied_applicant->other_names }} {{ $applied_applicant->first_name }}</td>
    </tr>
    <tr>
        <td>SEX: {{ $applied_applicant->sex }}</td>
        <td>DOB: {{ $applied_applicant->date_of_birth }}</td>
    </tr>
    <tr>
        <td>HEIGHT: {{ $applied_applicant->height }}</td>
        <td>WEIGHT: {{ $applied_applicant->weight }}</td>
    </tr>
    <tr>
        <td>CONTACT: {{ $applied_applicant->contact }}</td>
        <td>EMAIL: {{ $applied_applicant->email }}</td>
    </tr>
    <tr>
        <td>MARITAL STATUS: {{ $applied_applicant->marital_status }}</td>
        <td>ARM OF SERVICE: {{ $applied_applicant->arm_of_service }}</td>
    </tr>
    <tr>
        <td>TRADE TYPE: {{ $applied_applicant->trade_type }}</td>
        <td>BRANCH: {{ optional($applied_applicant->branches)->branch }}</td>
    </tr>
    <tr>
        <td>REGION: {{ optional($applied_applicant->regions)->region_name }}</td>
        <td>DISTRICT: {{ optional($applied_applicant->districts)->district_name }}</td>
    </tr>
    <tr>
        <td>HOMETOWN: {{ $applied_applicant->home_town }}</td>
        <td>RESIDENTIAL ADDRESS: {{ $applied_applicant->residential_address }}</td>
    </tr>
    <tr>
        <td>DIGITAL ADDRESS: {{ $applied_applicant->digital_address }}</td>
        <td>NATIONAL ID: {{ $applied_applicant->national_identity_card }}</td>
    </tr>
    <tr>
        <td>IDENTITY TYPE: {{ $applied_applicant->identity_type }}</td>
        <td>AGE: {{ $applied_applicant->age }}</td>
    </tr>
</table>

<table>
    <tr>
        <td>SECONDARY SCHOOL: {{ $applied_applicant->name_of_secondary_school }}</td>
        <td>COURSE OFFERED: {{ $applied_applicant->secondary_course_offered }}</td>
    </tr>
    <tr>
        <td>WASSCE INDEX NO: {{ $applied_applicant->wassce_index_number }}</td>
        <td>YEAR OF COMPLETION: {{ $applied_applicant->wassce_year_completion }}</td>
    </tr>
    <tr>
        <td>WASSCE SERIAL NO: {{ $applied_applicant->wassce_serial_number }}</td>
        <td>ENGLISH: {{ $applied_applicant->wassce_english }} - {{ $applied_applicant->wassce_subject_english_grade }}</td>
    </tr>
    <tr>
        <td>MATHEMATICS: {{ $applied_applicant->wassce_mathematics }} - {{ $applied_applicant->wassce_subject_maths_grade }}</td>
        <td>SUBJECT 3: {{ $applied_applicant->wassce_subject_three }} - {{ $applied_applicant->wassce_subject_three_grade }}</td>
    </tr>
    <tr>
        <td>SUBJECT 4: {{ $applied_applicant->wassce_subject_four }} - {{ $applied_applicant->wassce_subject_four_grade }}</td>
        <td>SUBJECT 5: {{ $applied_applicant->wassce_subject_five }} - {{ $applied_applicant->wassce_subject_five_grade }}</td>
    </tr>
    <tr>
        <td>SUBJECT 6: {{ $applied_applicant->wassce_subject_six }} - {{ $applied_applicant->wassce_subject_six_grade }}</td>
    </tr>

    {{-- BECE Section --}}
    <tr>
        <td>BECE INDEX NO: {{ $applied_applicant->bece_index_number }}</td>
        <td>YEAR OF COMPLETION: {{ $applied_applicant->bece_year_completion }}</td>
    </tr>
    <tr>
        <td>ENGLISH: {{ $applied_applicant->bece_english }} - {{ $applied_applicant->bece_subject_english_grade }}</td>
        <td>MATHEMATICS: {{ $applied_applicant->bece_mathematics }} - {{ $applied_applicant->bece_subject_maths_grade }}</td>
    </tr>
    <tr>
        <td>SUBJECT 3: {{ $applied_applicant->bece_subject_three }} - {{ $applied_applicant->bece_subject_three_grade }}</td>
        <td>SUBJECT 4: {{ $applied_applicant->bece_subject_four }} - {{ $applied_applicant->bece_subject_four_grade }}</td>
    </tr>
    <tr>
        <td>SUBJECT 5: {{ $applied_applicant->bece_subject_five }} - {{ $applied_applicant->bece_subject_five_grade }}</td>
        <td>SUBJECT 6: {{ $applied_applicant->bece_subject_six }} - {{ $applied_applicant->bece_subject_six_grade }}</td>
    </tr>

    {{-- Language & Sports --}}
    <tr>
        <td>LANGUAGES: {{ implode(', ', $applied_applicant->language ?? []) }}</td>
        <td>SPORTS INTEREST: {{ implode(', ', $applied_applicant->sports_interest ?? []) }}</td>
    </tr>

    {{-- Exam Types --}}
    <tr>
        <td>EXAM TYPE 1: {{ $applied_applicant->exam_type_one }}</td>
        <td>EXAM TYPE 2: {{ $applied_applicant->exam_type_two }}</td>
    </tr>
    <tr>
        <td>EXAM TYPE 3: {{ $applied_applicant->exam_type_three }}</td>
        <td>EXAM TYPE 4: {{ $applied_applicant->exam_type_four }}</td>
    </tr>
    <tr>
        <td>EXAM TYPE 5: {{ $applied_applicant->exam_type_five }}</td>
        <td>EXAM TYPE 6: {{ $applied_applicant->exam_type_six }}</td>
    </tr>

    {{-- Result Slips --}}
    <tr>
        <td>RESULT SLIP 1: {{ $applied_applicant->results_slip_one }}</td>
        <td>RESULT SLIP 2: {{ $applied_applicant->results_slip_two }}</td>
    </tr>
    <tr>
        <td>RESULT SLIP 3: {{ $applied_applicant->results_slip_three }}</td>
        <td>RESULT SLIP 4: {{ $applied_applicant->results_slip_four }}</td>
    </tr>
    <tr>
        <td>RESULT SLIP 5: {{ $applied_applicant->results_slip_five }}</td>
        <td>RESULT SLIP 6: {{ $applied_applicant->results_slip_six }}</td>
    </tr>

    {{-- National ID / Age --}}
    <tr>
        <td>NATIONAL ID: {{ $applied_applicant->national_identity_card }}</td>
        <td>IDENTITY TYPE: {{ $applied_applicant->identity_type }}</td>
    </tr>

</table>

<table>
    <tr>
        <td> <b>{{ $applied_applicant->surname }} {{ $applied_applicant->first_name }} {{ $applied_applicant->other_names }}</b>declare that all the information given on this form are correct to the best of my knowledge and understand that <span class="text-danger">any false statement or omission may be liable for prosecution.</span></td>
    </tr>
</table>

    <table>
        <tr align="center">
            @php $qrPath = public_path($applied_applicant->qr_code_path); @endphp
            <td>
                @if (file_exists($qrPath))
                    <img src="{{ $qrPath }}" width="60" height="60" class="image-border">
                @endif
            </td>
        </tr>
    </table>

    @if ($applied_applicant->qualification === 'DISQUALIFIED')
        <table>
            <tr>
                <td><strong>DISQUALIFICATION REASON:</strong> {{ $applied_applicant->disqualification_reason }}</td>
            </tr>
        </table>
    @endif
</div>
</body>
</html>
