<!DOCTYPE html>
<html>
<head>
    <title>Applicant Summary Sheet</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            position: relative;
            min-height: auto;
            width: 100%;
            overflow: hidden;
        }
       .background-gaf {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ public_path('GAF.png') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
        opacity: 0.1; /* faint */
        z-index: -2;
       }

    /* Star image repeated faintly */
    .background-stars {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ public_path('star.jpg') }}');
        background-repeat: repeat;
        background-size: 60px; /* adjust size */
        opacity: 0.05; /* very faint */
        z-index: -1;
    }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
           min-height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 40px;
            page-break-inside: avoid;
        }

        th,
        td {
            border: none;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        img {
            border: none;
            display: block;
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .status-right {
            text-align: right;
            padding-right: 20px;
        }

        .image-border {
            border: 2px solid #000;
            border-radius: 4px;
        }
        /* Avoid page breaks within important elements */
        .no-break {
            page-break-inside: avoid;
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
        <td><b>GAF NUMBER:</b></td>
        <td>{{ $applied_applicant->applicant_serial_number }}</td>

        <td><b>FULL NAME:</b></td>
        <td>{{ $applied_applicant->surname }} {{ $applied_applicant->other_names }}</td>
    </tr>
    <tr>
        <td><b>SEX:</b></td>
        <td>{{ $applied_applicant->sex }}</td>

        <td><b>DATE OF BIRTH:</b></td>
        <td>{{ $applied_applicant->date_of_birth }}</td>
    </tr>
    <tr>
        <td><b>HEIGHT:</b></td>
        <td>{{ $applied_applicant->height }}</td>

        <td><b>WEIGHT:</b></td>
        <td>{{ $applied_applicant->weight }}</td>
    </tr>
    <tr>
        <td><b>CONTACT:</b></td>
        <td>{{ $applied_applicant->contact }}</td>

        <td><b>EMAIL:</b></td>
        <td>{{ $applied_applicant->email }}</td>
    </tr>
    <tr>
        <td><b>MARITAL STATUS:</b></td>
        <td>{{ $applied_applicant->marital_status }}</td>

        <td><b>ARM OF SERVICE:</b></td>
        <td>{{ $applied_applicant->arm_of_service }}</td>
    </tr>
    <tr>
        <td><b>TRADE TYPE:</b></td>
        <td>{{ $applied_applicant->trade_type }}</td>

        <td><b>BRANCH:</b></td>
        <td>{{ optional($applied_applicant->branches)->branch }}</td>
    </tr>
    <tr>
        <td><b>REGION:</b></td>
        <td>{{ $applied_applicant->region }}</td>

        <td><b>DISTRICT:</b></td>
        <td>{{ $applied_applicant->district }}</td>
    </tr>
    <tr>
        <td><b>PLACE OF BIRTH:</b></td>
        <td>{{ $applied_applicant->place_of_birth }}</td>

        <td><b>HOMETOWN:</b></td>
        <td>{{ $applied_applicant->hometown }}</td>
    </tr>
    <tr>
        <td><b>EMPLOYMENT:</b></td>
        <td>{{ $applied_applicant->employment }}</td>

        <td><b>RESIDENTIAL ADDRESS:</b></td>
        <td>{{ $applied_applicant->residential_address }}</td>
    </tr>
    <tr>
        <td><b>DIGITAL ADDRESS:</b></td>
        <td>{{ $applied_applicant->digital_address }}</td>

        <td><b>NATIONAL ID:</b></td>
        <td>{{ $applied_applicant->national_identity_card }}</td>
    </tr>
    <tr>
        <td><b>AGE:</b></td>
        <td>{{ $applied_applicant->age }}</td>
        <td><b>IDENTITY TYPE:</b></td>
        <td>{{ $applied_applicant->identity_type }}</td>
    </tr>

</table>

<table>
    <tr>
        <td><b>SECONDARY SCHOOL:</b></td>
        <td>{{ $applied_applicant->name_of_secondary_school }}</td>

        <td><b>COURSE OFFERED:</b></td>
        <td>{{ $applied_applicant->secondary_course_offered }}</td>
    </tr>
    <tr>
        <td><b>WASSCE INDEX NO:</b></td>
        <td>{{ $applied_applicant->wassce_index_number }}</td>

        <td><b>YEAR OF COMPLETION:</b></td>
        <td>{{ $applied_applicant->wassce_year_completion }}</td>
    </tr>
    <tr>
        <td><b>WASSCE SERIAL NO:</b></td>
        <td>{{ $applied_applicant->wassce_serial_number }}</td>

        <td><b>ENGLISH:</b></td>
        <td>{{ $applied_applicant->wassce_english }} - {{ $applied_applicant->wassce_subject_english_grade }}</td>
    </tr>
    <tr>
        <td><b>MATHEMATICS:</b></td>
        <td>{{ $applied_applicant->wassce_mathematics }} - {{ $applied_applicant->wassce_subject_maths_grade }}</td>

        <td><b>SUBJECT 3:</b></td>
        <td>{{ $applied_applicant->wassce_subject_three }} - {{ $applied_applicant->wassce_subject_three_grade }}</td>
    </tr>
    <tr>
        <td><b>SUBJECT 4:</b></td>
        <td>{{ $applied_applicant->wassce_subject_four }} - {{ $applied_applicant->wassce_subject_four_grade }}</td>

        <td><b>SUBJECT 5:</b></td>
        <td>{{ $applied_applicant->wassce_subject_five }} - {{ $applied_applicant->wassce_subject_five_grade }}</td>
    </tr>
    <tr>
        <td><b>SUBJECT 6:</b></td>
        <td>{{ $applied_applicant->wassce_subject_six }} - {{ $applied_applicant->wassce_subject_six_grade }}</td>

    </tr>

    {{-- BECE Section --}}
    <tr>
        <td><b>BECE INDEX NO:</b></td>
        <td>{{ $applied_applicant->bece_index_number }}</td>

        <td><b>YEAR OF COMPLETION:</b></td>
        <td>{{ $applied_applicant->bece_year_completion }}</td>
    </tr>
    <tr>
        <td><b>ENGLISH:</b></td>
        <td>{{ $applied_applicant->bece_english }} - {{ $applied_applicant->bece_subject_english_grade }}</td>

        <td><b>MATHEMATICS:</b></td>
        <td>{{ $applied_applicant->bece_mathematics }} - {{ $applied_applicant->bece_subject_maths_grade }}</td>
    </tr>
    <tr>
        <td><b>SUBJECT 3:</b></td>
        <td>{{ $applied_applicant->bece_subject_three }} - {{ $applied_applicant->bece_subject_three_grade }}</td>

        <td><b>SUBJECT 4:</b></td>
        <td>{{ $applied_applicant->bece_subject_four }} - {{ $applied_applicant->bece_subject_four_grade }}</td>
    </tr>
    <tr>
        <td><b>SUBJECT 5:</b></td>
        <td>{{ $applied_applicant->bece_subject_five }} - {{ $applied_applicant->bece_subject_five_grade }}</td>

        <td><b>SUBJECT 6:</b></td>
        <td>{{ $applied_applicant->bece_subject_six }} - {{ $applied_applicant->bece_subject_six_grade }}</td>
    </tr>


    {{-- Language & Sports --}}
    <tr>
        <td><b>LANGUAGES:</b></td>
        <td>{{ implode(', ', $applied_applicant->language ?? []) }}</td>

        <td><b>SPORTS INTEREST:</b></td>
        <td>{{ implode(', ', $applied_applicant->sports_interest ?? []) }}</td>
    </tr>

    {{-- Professional / Exam Types --}}
    <tr>
        <td><b>EXAM TYPE 1:</b></td>
        <td>{{ $applied_applicant->exam_type_one }}</td>

        <td><b>EXAM TYPE 2:</b></td>
        <td>{{ $applied_applicant->exam_type_two }}</td>
    </tr>
    <tr>
        <td><b>EXAM TYPE 3:</b></td>
        <td>{{ $applied_applicant->exam_type_three }}</td>

        <td><b>EXAM TYPE 4:</b></td>
        <td>{{ $applied_applicant->exam_type_four }}</td>
    </tr>
    <tr>
        <td><b>EXAM TYPE 5:</b></td>
        <td>{{ $applied_applicant->exam_type_five }}</td>

        <td><b>EXAM TYPE 6:</b></td>
        <td>{{ $applied_applicant->exam_type_six }}</td>
    </tr>

    {{-- Result Slips --}}
    <tr>
        <td><b>RESULT SLIP 1:</b></td>
        <td>{{ $applied_applicant->results_slip_one}}</td>

        <td><b>RESULT SLIP 2:</b></td>
        <td>{{ $applied_applicant->results_slip_two}}</td>
    </tr>
    <tr>
        <td><b>RESULT SLIP 3:</b></td>
        <td>{{ $applied_applicant->results_slip_three}}</td>

        <td><b>RESULT SLIP 4:</b></td>
        <td>{{ $applied_applicant->results_slip_four}}</td>
    </tr>
    <tr>
        <td><b>RESULT SLIP 5:</b></td>
        <td>{{ $applied_applicant->results_slip_five}}</td>

        <td><b>RESULT SLIP 6:</b></td>
        <td>{{ $applied_applicant->results_slip_six}}</td>
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
