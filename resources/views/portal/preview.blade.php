@extends('portal.master')
@section('title')
PREVIEW
@endsection
@section('content')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .input_container {
            border: 1px solid #e5e5e5;
            /* height: 42px; */
        }
        input[type=file]::file-selector-button {
            background-color: #fff;
            color: #000;
            border: 0px;
            border-right: 1px solid #e5e5e5;
            /* padding: 10px 15px; */
            margin-right: 10px;
            transition: .5s;

        }
        input[type=file]::file-selector-button:hover {
            background-color: #eee;
            border: 0px;
            border-right: 1px solid #e5e5e5;
        }
        #img-upload {
            /* width: 255px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                height: 220px; */
            width: 100%;
        }
        span.form-control {
    display: block;
    padding: 6px;
    border: 1px solid #ced4da;
    background: #f8f9fa;
    border-radius: 4px;
}
 .body {
 background-image: url('{{ asset('new.jpg') }}');
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <body class="body">
        <section class="pcoded-apply-container">
            <div class="pcoded-content">
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <nav class="navbar justify-content-between p-0 align-items-center">
                                        <h5>Home</h5>
                                        <div class="input-group" style="width: auto;">
                                            <div class="col text-right">
                                                <div class="btn-group mb-2 mr-2" style="display: inline-block;">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link"
                                                            style="color: white;">Logout</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </nav>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a>
                                    </li>
                                   <li class="breadcrumb-item"><a href="#!">ARM OF SERVICE:
                                            {{ $applied_applicant->arm_of_service }} / TYPE: {{ $applied_applicant->trade_type }}</a></li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="text-align: center; font-family: Arial Black, Helvetica, sans-serif;">
                                   GHANA ARMED FORCES  COLLEGE OF NURSING AND MIDWIFERY ONLINE PORTAL
                                </h4>
                                <marquee behavior="scroll" direction="left" scrollamount="2"
                                    style="font-family: Arial, sans-serif; font-size: 16px; color: #ff0000; font-weight: bold; text-transform: uppercase;">
                                    CAREFULLY REVIEW THE INFORMATION YOU PROVIDED BELOW. ONCE SUBMITTED, IT CANNOT BE CHANGED. AND CLICK ON THE CHECK BUTTON TO MAKE YOUR FINAL SUBMISSION.
                                </marquee>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Application Form</h5>
                            </div>
                            <div class="card-body" style="margin-left: 2cm; margin-right: 2cm;">
                                <div class="bt-wizard" id="progresswizard">
                                    <ul class="nav nav-pills nav-fill mb-3"
                                        style="text-align: center; font-family: Arial Black, Helvetica, sans-serif;">
                                        <li class="nav-item"><a href="#b-w-tab4" class="nav-link"
                                                data-toggle="tab">PREVIEW</a></li>
                                        <li class="nav-item"><a href="{{ route('bio-data') }}" class="nav-link">BIO
                                                DATA
                                                DETAILS (AMENDMENT)</a></li>
                                        <li class="nav-item"><a href="{{ route('education-details') }}"
                                                class="nav-link">EDUCATIONAL
                                                DETAILS (AMENDMENT)</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="b-w-tab4">
                                            <div class="text-center">
                                                <div class="alert alert-danger" role="alert">
                                                    <h5>Carefully review the information you provided below. Once
                                                        submitted it cannot be changed.</h5>
                                                </div>
                                                <hr>
                                                <h4 class="text-center"
                                                    style="font-weight: bolder;text-transform: uppercase; margin-top: 20px; margin-bottom: 20px;">
                                                    Applicant Details
                                                </h4>
                                                <hr>
                                                @php
                                                    $imagePath = public_path($applied_applicant->applicant_image);
                                                @endphp
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <td>
                                                            @if (file_exists($imagePath))
                                                                <img id="showImage"
                                                                    src="{{ asset($applied_applicant->applicant_image) }}"
                                                                    alt="" width="200px" class="img-thumbnail">
                                                            @else
                                                                <img id="showImage"
                                                                    src="{{ asset('assets/images/img_placeholder_avatar.jpg') }}"
                                                                    alt="" width="200px" class="img-thumbnail">
                                                            @endif
                                                        </td>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="container" id="printTable">
                                                                <div>
                                                                    <h5 style="margin-top: 10px; color:red"><b>
                                                                          ARM OF SERVICE SELECTED:
                                                                            {{ $applied_applicant->arm_of_service }}  /  BRANCH SELECTED:
                                                                            {{ $applied_applicant->branches->branch??'' }}


                                                                        </b>
                                                                    </h5>
                                                                    <span></span>
                                                                    <h5 class="mt-5"
                                                                        style="text-transform: uppercase; text-align:left; margin-left: 0.5cm">
                                                                        Biodata details</h5>
                                                                    <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Surname</th>
                                                                                        <th>First Name</th>
                                                                                        <th>Other Name(s)</th>
                                                                                        <th>Sex</th>
                                                                                        <th>Marital Status</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-surname">
                                                                                            {{ $applied_applicant->surname }}
                                                                                        </td>
                                                                                          <td id="preview-first">
                                                                                            {{ $applied_applicant->first_name }}
                                                                                        </td>
                                                                                        <td id="preview-othernames">
                                                                                            {{ $applied_applicant->other_names }}
                                                                                        </td>
                                                                                        <td id="preview-sex">
                                                                                            {{ $applied_applicant->sex }}
                                                                                        </td>
                                                                                        <td id="preview-marital-status">
                                                                                            {{ $applied_applicant->marital_status }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Date of Birth</th>
                                                                                        <th>Mobile</th>
                                                                                        <th>Email</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-date-of-birth">
                                                                                            {{ strtoupper(\Carbon\Carbon::parse($applied_applicant->date_of_birth)->format('d F Y')) }}
                                                                                        </td>
                                                                                        <td id="preview-contact">
                                                                                            {{ $applied_applicant->contact }}
                                                                                        </td>
                                                                                        <td id="preview-email">
                                                                                            {{ $applied_applicant->email }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>



                                                                 <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Region</th>
                                                                                        <th>District</th>
                                                                                        <th>Home Town</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-date-of-birth">
                                                                                           {{ $applied_applicant->regions->region_name ??'' }}
                                                                                        </td>
                                                                                        <td id="preview-contact">
                                                                                            {{ $applied_applicant->districts->district_name ??'' }}
                                                                                        </td>
                                                                                        <td id="preview-email">
                                                                                            {{ $applied_applicant->home_town }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                     <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Identity Type</th>
                                                                                        <th>Card Number</th>

                                                                                         <th>Height</th>
                                                                                        <th>Weight</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>

                                                                                        <td id="preview-identity_type">
                                                                                            {{ $applied_applicant->identity_type}}
                                                                                        </td>
                                                                                        <td id="preview-national_identity_card">
                                                                                            {{ $applied_applicant->national_identity_card }}
                                                                                        </td>
                                                                                        <td id="preview-identity_type">
                                                                                            {{ $applied_applicant->height}}
                                                                                        </td>
                                                                                        <td id="preview-national_identity_card">
                                                                                            {{ $applied_applicant->weight}}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered mb-0">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Residential Address</th>
                                                                                        <th>Language(s) Spoken</th>
                                                                                        <th>Sports Interest</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-residential-address">
                                                                                            {{ $applied_applicant->residential_address }}
                                                                                        </td>
                                                                                        <td id="preview-languages">
                                                                                            @php
                                                                                                $languages = is_string($applied_applicant->language)
                                                                                                    ? json_decode($applied_applicant->language, true)
                                                                                                    : $applied_applicant->language;
                                                                                            @endphp
                                                                                            {{ implode(', ', $languages ?? []) }}
                                                                                        </td>

                                                                                        <td id="preview-sports-interest">
                                                                                            @php
                                                                                                $sports = is_string($applied_applicant->sports_interest)
                                                                                                    ? json_decode($applied_applicant->sports_interest, true)
                                                                                                    : $applied_applicant->sports_interest;
                                                                                            @endphp
                                                                                            {{ implode(', ', $sports ?? []) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>



                                                                    <h5 class="mt-5"
                                                                        style="text-transform: uppercase; text-align:left; margin-left: 0.5cm">
                                                                        Educational details</h5>


                                                                    <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered mb-0">
                                                                                <thead>
                                                                                    <tr>

                                                                                        <th>WASSCE Index Number</th>
                                                                                        <th>SHS Completion Year</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="wassce_index_number">
                                                                                            {{ $applied_applicant->wassce_index_number }}
                                                                                        </td>
                                                                                        <td id="wassce_year_completion">
                                                                                            {{ strtoupper(\Carbon\Carbon::parse($applied_applicant->wassce_year_completion)->format('d F Y')) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row"
                                                                        style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <th>BECE Index Number</th>
                                                                                <th>JHS Completion Year</th>
                                                                                <th>WASSCE Index Number</th>
                                                                                <th>SHS Completion Year</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td id="preview-bece-index">
                                                                                        <b></b>
                                                                                        {{ $applied_applicant->bece_index_number }}
                                                                                    </td>
                                                                                    <td id="preview-jhs-completion-year">
                                                                                        <b></b>
                                                                                       {{ strtoupper(\Carbon\Carbon::parse($applied_applicant->bece_year_completion)->format('d F Y')) }}

                                                                                    </td>
                                                                                    <td id="wassce_index_number">
                                                                                        <b></b>
                                                                                        {{ $applied_applicant->wassce_index_number }}
                                                                                    </td>
                                                                                    <td id="wassce_year_completion">
                                                                                        <b></b>
                                                                                       {{ strtoupper(\Carbon\Carbon::parse($applied_applicant->wassce_year_completion)->format('d F Y')) }}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="row"
                                                                        style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <th>BECE Subjects</th>
                                                                                <th>Grades</th>
                                                                                <th>Exams Type</th>
                                                                                <th>WASSCE Subjects</th>
                                                                                <th>Grades</th>
                                                                                <th>Result slip Number</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="bece_english" class="form-control col-sm-12 required">
                                                                                                {{ $applied_applicant->bece_english }}
                                                                                            </span>
                                                                                            <span id="bece_maths" class="form-control required">
                                                                                                {{ $applied_applicant->bece_mathematics }}
                                                                                            </span>
                                                                                            <span id="bece_sub1" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_three }}
                                                                                            </span>
                                                                                            <span id="bece_sub2" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_four }}
                                                                                            </span>
                                                                                            <span id="bece_sub3" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_five }}
                                                                                            </span>
                                                                                            <span id="bece_sub4" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_six }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>

                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="bece_english_grade" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_english_grade }}
                                                                                            </span>
                                                                                            <span id="bece_maths_grade" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_maths_grade }}
                                                                                            </span>
                                                                                            <span id="bece_sub1" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_three_grade }}
                                                                                            </span>
                                                                                            <span id="bece_sub2" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_four_grade }}
                                                                                            </span>
                                                                                            <span id="bece_sub3" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_five_grade }}
                                                                                            </span>
                                                                                            <span id="bece_sub4" class="form-control required">
                                                                                                {{ $applied_applicant->bece_subject_six_grade }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>


                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="exam_type_one" class="form-control required">
                                                                                                {{ $applied_applicant->exam_type_one }}
                                                                                            </span>
                                                                                            <span id="exam_type_two" class="form-control required">
                                                                                                {{ $applied_applicant->exam_type_two }}
                                                                                            </span>
                                                                                            <span id="wassce_sub1" class="form-control">
                                                                                                {{ $applied_applicant->exam_type_three }}
                                                                                            </span>
                                                                                            <span id="wassce_sub2" class="form-control">
                                                                                                {{ $applied_applicant->exam_type_four }}
                                                                                            </span>
                                                                                            <span id="wassce_sub3" class="form-control">
                                                                                                {{ $applied_applicant->exam_type_five }}
                                                                                            </span>
                                                                                            <span id="wassce_sub4" class="form-control">
                                                                                                {{ $applied_applicant->exam_type_six }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>
                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="wassce_english" class="form-control">
                                                                                                {{ $applied_applicant->wassce_english }}
                                                                                            </span>
                                                                                            <span id="wassce_maths" class="form-control">
                                                                                                {{ $applied_applicant->wassce_mathematics }}
                                                                                            </span>
                                                                                            <span id="wassce_sub1" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_three }}
                                                                                            </span>
                                                                                            <span id="wassce_sub2" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_four }}
                                                                                            </span>
                                                                                            <span id="wassce_sub3" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_five }}
                                                                                            </span>
                                                                                            <span id="wassce_sub4" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_six }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>

                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="wassce_english_grade" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_english_grade }}
                                                                                            </span>
                                                                                            <span id="wassce_maths_grade" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_maths_grade }}
                                                                                            </span>
                                                                                            <span id="wassce_sub1" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_three_grade }}
                                                                                            </span>
                                                                                            <span id="wassce_sub2" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_four_grade }}
                                                                                            </span>
                                                                                            <span id="wassce_sub3" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_five_grade }}
                                                                                            </span>
                                                                                            <span id="wassce_sub4" class="form-control">
                                                                                                {{ $applied_applicant->wassce_subject_six_grade }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>
                                                                                    <td>
                                                                                        <b>
                                                                                            <span id="results_slip_one" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_one }}
                                                                                            </span>
                                                                                            <span id="results_slip_two" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_two }}
                                                                                            </span>
                                                                                            <span id="results_slip_three" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_three }}
                                                                                            </span>
                                                                                            <span id="results_slip_four" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_four }}
                                                                                            </span>
                                                                                            <span id="results_slip_five" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_five }}
                                                                                            </span>
                                                                                            <span id="results_slip_six" class="form-control">
                                                                                                {{ $applied_applicant->results_slip_six }}
                                                                                            </span>
                                                                                        </b>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    @if($applied_applicant->entrance_type === 'TOP UP')
                                                                        <div class="row" style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>INSTITUTION</th>

                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td  colspan="3"><b>{{ $applied_applicant->institution }}</b></td>

                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                    @endif
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div style="">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-12">
                                                                                <h5 class="mt-12" style="color: red">
                                                                                    Applicant Declaration</h5>
                                                                                <hr>
                                                                                <form action="{{ route('declaration-and-acceptance') }}" method="POST" id="declarationForm">
                                                                                    @csrf
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            class="custom-control-input"
                                                                                            id="customCheck1"
                                                                                            name="final_checked"
                                                                                            value="YES">
                                                                                        <label class="custom-control-label"
                                                                                            for="customCheck1">
                                                                                            I <b>{{ $applied_applicant->surname }} {{ $applied_applicant->first_name }}
                                                                                                {{ $applied_applicant->other_names }}</b>
                                                                                            declare that all the information
                                                                                            given on this form are correct
                                                                                            to the best of my knowledge and
                                                                                            understand that
                                                                                            <span class="text-danger">any
                                                                                                false statement or omission
                                                                                                may be liable for
                                                                                                prosecution.</span>
                                                                                        </label>
                                                                                        @error('final_checked')
                                                                                            <span
                                                                                                class="badge badge-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <button type="submit"
                                                                                                class="btn btn-success">Submit
                                                                                                Application</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </body>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('final-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'duplicate') {
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate Entry',
                text: data.message,
                confirmButtonText: 'OK',
                timer: 2000, // Optional: auto-close after 2s
                timerProgressBar: true,
            }).then(() => {
                window.location.href = data.redirect_url;
            });
        } else if (data.status === 'error') {
            window.location.href = data.pdf_url;
        } else {
            // Handle other success case
        }
    });
});
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--  Js -->
    <script src="{{ asset('frontend/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ripple.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/daterangepicker.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/pages/ac-datepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.full.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/pages/form-select-custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.getElementById('declarationForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const checkbox = document.getElementById('customCheck1');

    if (!checkbox.checked) {
        Swal.fire({
            icon: 'warning',
            title: 'Declaration Required',
            text: 'You must agree to the declaration before submitting.',
        });
        return;
    }

    // ✅ Show processing popup
    Swal.fire({
        title: 'Processing Application',
        text: 'YOUR APPLICATION IS PROCESSING. THANK YOU!',
        icon: 'info',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Proceed with form submission via fetch
    const form = this;
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data); // Debugging log

        if (data.status === 'duplicate') {
            // 🔥 Show SweetAlert if duplicate
            Swal.fire({
                icon: 'warning',
                title: 'Duplicate Entry',
                text: data.message || 'Your information already exists in the portal.',
                confirmButtonText: 'OK',
                timer: 3000,
                timerProgressBar: true,
            }).then(() => {
                window.location.href = data.redirect_url || '/Portal';
            });
        }
        else if (data.status === 'error') {
            // ❌ Disqualified: Open PDF and logout after delay
            if (data.pdf_url) {
                window.open(data.pdf_url, '_blank');
            }
            setTimeout(() => logoutUser(), 500);
        }
        else if (data.status === 'success') {
            // ✅ Qualified: Open PDF and logout
            if (data.pdf_url) {
                window.open(data.pdf_url, '_blank');
            }
            setTimeout(() => logoutUser(), 500);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Submission Failed',
            text: 'An error occurred while submitting. Please try again.',
        });
    });
});

function logoutUser() {
    fetch('{{ route('apply_logout') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        }
    })
    .then(() => {
        window.location.href = '/Portal';
    })
    .catch(error => console.error('Logout failed:', error));
}
</script>

{{--
    <script>
        document.getElementById('declarationForm').addEventListener('submit', function(e) {
            e.preventDefault(); // 🛑 Prevent default form submission first
    const checkbox = document.getElementById('customCheck1');
    if (!checkbox.checked) {
        Swal.fire({
            icon: 'warning',
            title: 'Declaration Required',
            text: 'You must agree to the declaration before submitting.',
        });
        return; // ❗ Exit early so form doesn't proceed
    }
            // Proceed with form submission
            e.preventDefault(); // Prevent default form submission
            let form = this;
            let formData = new FormData(form);
            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response Data:', data); // Debugging log
                    // Open the PDF in a new tab regardless of qualified or disqualified status
                    window.open(data.pdf_url, '_blank');
                    // Short delay before logging out
                    setTimeout(() => {
                        logoutUser();
                    }, 500); // 500ms delay to ensure PDF opens first
                })
                .catch(error => console.error('Error:', error));
        });

        function logoutUser() {
            fetch('{{ route('apply_logout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                })
                .then(() => {
                    // After logging out, redirect the user to the portal page
                    window.location.href = '/Portal';
                })
                .catch(error => console.error('Logout failed:', error));
        }
    </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });
            $('.btn-file :file').on('fileselect', function(event, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                if (input.length) {
                    input.val(log);
                } else {
                    if (log) alert(log);
                }

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imgInp").change(function() {
                readURL(this);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#besicwizard').bootstrapWizard({
                withVisible: false,
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                'firstSelector': '.button-first',
                'lastSelector': '.button-last'
            });
            $('#btnwizard').bootstrapWizard({
                withVisible: false,
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                'firstSelector': '.button-first',
                'lastSelector': '.button-last'
            });
            $('#progresswizard').bootstrapWizard({
                withVisible: false,
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                'firstSelector': '.button-first',
                'lastSelector': '.button-last',
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index + 1;
                    var $percent = ($current / $total) * 100;
                    $('#progresswizard .progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });
            $('#validationwizard').bootstrapWizard({
                withVisible: false,
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                'firstSelector': '.button-first',
                'lastSelector': '.button-last',
                onNext: function(tab, navigation, index) {
                    if (index == 1) {
                        if (!$('#validation-t-name').val()) {
                            $('#validation-t-name').focus();
                            $('.form-1').addClass('was-validated');
                            return false;
                        }
                        if (!$('#validation-t-email').val()) {
                            $('#validation-t-email').focus();
                            $('.form-1').addClass('was-validated');
                            return false;
                        }
                        if (!$('#validation-t-pwd').val()) {
                            $('#validation-t-pwd').focus();
                            $('.form-1').addClass('was-validated');
                            return false;
                        }
                    }
                    if (index == 2) {
                        if (!$('#validation-t-address').val()) {
                            $('#validation-t-address').focus();
                            $('.form-2').addClass('was-validated');
                            return false;
                        }
                    }
                }
            });
            $('#tabswizard').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
            });
            $('#verticalwizard').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
            });
        });
    </script>
    <script type="text/javascript">
        $('#jhs_completion_year').datepicker({
            format: "yyyy",
            endDate: "31/12/2024",
            startView: 2,
            minViewMode: 2,
            autoclose: true,
            calendarWeeks: true

        });
    </script>



@endsection
