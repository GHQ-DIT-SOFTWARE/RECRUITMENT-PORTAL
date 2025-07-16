<!DOCTYPE html>
<html>

<head>
    <title>Applicant Summary Sheet</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            position: relative;
            min-height: 100vh;
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
            min-height: 100vh;
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
        <table class="no-break">
            <tr>
                <td><b>GHANA ARMED FORCES</b></td>
                <td></td>
                <td class="status-right"><b>STATUS:</b> {{ $applied_applicant->qualification }}</td>
            </tr>
            <tr>
                <td><b>ONLINE RECRUITMENT.</b></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <p style="margin:0"><b>APPLIED AT:</b>
                        {{ \Carbon\Carbon::parse($applied_applicant->created_at)->format('d M, Y h:i A') }}
                    </p>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <p align="center"><b>APPLICATION SUMMARY REPORT</b></p>

        <table class="no-break">
            <tr align="center">
                @php
                    $imagePath = public_path($applied_applicant->applicant_image);
                @endphp
                <td>
                    @if (file_exists($imagePath))
                        <img id="showImage" src="{{ public_path($applied_applicant->applicant_image) }}" alt=""
                            height="160px" width="160px" class="img-thumbnail image-border">
                    @else
                        <img id="showImage" src="{{ asset('assets/images/img_placeholder_avatar.jpg') }}" alt=""
                            width="160px" class="img-thumbnail image-border">
                    @endif
                </td>
            </tr>
        </table>

        <table class="no-break">
            <tr>
                <td><b>GAF NUMBER:</b></td>
                <td>{{ $applied_applicant->applicant_serial_number }}</td>
            </tr>
            <tr>
                <td><b>ARM OF SERVICE:</b></td>
                <td>{{ $applied_applicant->arm_of_service }}</td>
            </tr>
            <tr>
                <td><b>TRADE TYPE:</b></td>
                <td>{{ $applied_applicant->trade_type }}</td>
            </tr>
            <tr>
                <td><b>BRANCH:</b></td>
                <td>{{ $applied_applicant->branches->branch }}</td>
            </tr>
        </table>

        <table class="no-break">
            <tr align="center">
                @php
                    $imagePath = public_path($applied_applicant->qr_code_path);
                @endphp
                <td>
                    @if (file_exists($imagePath))
                        <img id="showImage" src="{{ public_path($applied_applicant->qr_code_path) }}" alt=""
                            class="img-thumbnail image-border" height="160px" width="160px">
                    @endif
                </td>
            </tr>
        </table>

        <table class="no-break">
            @if (!is_null($applied_applicant->disqualification_reason))
                <tr>
                    <td colspan="8">
                        <b>DISQUALIFICATION REASON:</b> {{ $applied_applicant->disqualification_reason }}
                    </td>
                </tr>
            @endif
        </table>
    </div>
</body>

</html>
