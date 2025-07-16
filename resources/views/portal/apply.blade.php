@extends('portal.master')
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
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">

    <body
        class=""style="background-image: url('assets/images/nav-bg/body-bg-9.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
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
                                                            style="color: white;">Cancel Application</button>
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
                                            {{ $applied_applicant->arm_of_service }}</a></li>
                                    <li class="breadcrumb-item"><a href="#!">COMMISSION TYPE:
                                            {{ $applied_applicant->commission_type }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($applied_applicant->final_checked != 'YES')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 style="text-align: center; font-family: Arial Black, Helvetica, sans-serif;">
                                        GHANA ARMED FORCES - ONLINE ENLISTMENT PORTAL
                                    </h4>
                                    <marquee behavior="scroll" direction="left" scrollamount="2"
                                        style="font-family: Arial, sans-serif; font-size: 16px; color: #ff0000; font-weight: bold; text-transform: uppercase;">
                                        PLEASE COMPLETE THE VARIOUS FORMS BY CLICKING "NEXT" TO COMPLETE YOUR APPLICATION.
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
                                            <li class="nav-item"><a href="#b-w-tab1" class="nav-link active"
                                                    data-toggle="tab">BIO DATA DETAILS</a></li>
                                            <li class="nav-item"><a href="#b-w-tab2" class="nav-link"
                                                    data-toggle="tab">EDUCATIONAL DETAILS</a></li>
                                            <li class="nav-item"><a href="#b-w-tab3" class="nav-link"
                                                    data-toggle="tab">PROFESSIONAL DETAILS</a></li>
                                            <li class="nav-item"><a href="#b-w-tab4" class="nav-link"
                                                    data-toggle="tab">PREVIEW</a></li>
                                        </ul>
                                        <div id="bar" class="bt-wizard progress mb-3" style="height:6px">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0"
                                                aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane active show" id="b-w-tab1" style="text-align: right">
                                                <form id="form1" action="{{ route('saveBioData') }}"
                                                    method="POST"enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        @php
                                                            $imagePath = public_path(
                                                                $applied_applicant->applicant_image,
                                                            );
                                                        @endphp
                                                        <div class="col-md-2 border-right">
                                                            <div
                                                                class="d-flex flex-column align-items-center text-center p-1 py-5">
                                                                @if (file_exists($imagePath))
                                                                    <img id="showImage"
                                                                        src="{{ asset($applied_applicant->applicant_image) }}"
                                                                        alt="" class="rounded-circle mt-2"
                                                                        height="150px" width="150px">
                                                                @else
                                                                    <img id="showImage"
                                                                        src="{{ asset('assets/images/img_placeholder_avatar.jpg') }}"
                                                                        alt="" class="rounded-circle mt-2"
                                                                        height="150px" width="150px">
                                                                @endif
                                                                <span class="font-weight-bold">Passport Picture</span>
                                                                <div class="form-group row">
                                                                    <div class="input_container">
                                                                        <input name="applicant_image" class="form-control"
                                                                            type="file" id="image"
                                                                            accept=".jpg, .png">
                                                                        @error('applicant_image')
                                                                            <div class="alert alert-danger mt-2">
                                                                                {{ $message }} Please upload a valid file
                                                                                (jpg,
                                                                                png).
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <div class="form-group row">
                                                                <label for="branch"
                                                                    class="col-sm-2 col-form-label">Select
                                                                    Vacancy</label>
                                                                <div class="col-sm-2">
                                                                    <select id="branch" name="branch"
                                                                        class="form-control required">
                                                                        <option value="">Select Branch</option>
                                                                    </select>
                                                                </div>
                                                                <label for="course"
                                                                    class="col-sm-2 col-form-label">Select
                                                                    Course</label>
                                                                <div class="col-sm-2">
                                                                    <select id="course" name="course"
                                                                        class="form-control required">
                                                                        <option value="">Select Course</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Surname</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        id="surname" name="surname" placeholder=""
                                                                        value="{{ old('surname', $applied_applicant->surname) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Other
                                                                    Name(s)</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        id="other_names" name="other_names"
                                                                        placeholder=""
                                                                        value="{{ old('other_names', $applied_applicant->other_names) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Sex</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control required" id="sex"
                                                                        name="sex">
                                                                        <option value="">Select</option>
                                                                        <option value="MALE"
                                                                            {{ old('sex', $applied_applicant->sex) == 'MALE' ? 'selected' : '' }}>
                                                                            MALE</option>
                                                                        <option value="FEMALE"
                                                                            {{ old('sex', $applied_applicant->sex) == 'FEMALE' ? 'selected' : '' }}>
                                                                            FEMALE</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Marital
                                                                    Status</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control required"
                                                                        id="marital_status" name="marital_status">
                                                                        <option value="">Choose option</option>
                                                                        <option value="SINGLE"
                                                                            {{ old('marital_status', $applied_applicant->marital_status) == 'SINGLE' ? 'selected' : '' }}>
                                                                            SINGLE</option>
                                                                        <option value="MARRIED"
                                                                            {{ old('marital_status', $applied_applicant->marital_status) == 'MARRIED' ? 'selected' : '' }}>
                                                                            MARRIED</option>
                                                                        <option value="DIVORSED"
                                                                            {{ old('marital_status', $applied_applicant->marital_status) == 'DIVORSED' ? 'selected' : '' }}>
                                                                            DIVORSED</option>
                                                                    </select>
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Height
                                                                    (Feet/Inches)</label>
                                                                <div class="col-sm-2">
                                                                    <select id="height" name="height"
                                                                        class="form-control required">
                                                                        <option value="">Select</option>
                                                                        @for ($i = 5; $i <= 7; $i++)
                                                                            @for ($j = 0; $j <= 11; $j++)
                                                                                @php $value = $i . '.' . $j; @endphp
                                                                                <option value="{{ $value }}"
                                                                                    {{ old('height', $applied_applicant->height) == $value ? 'selected' : '' }}>
                                                                                    {{ $value }}</option>
                                                                            @endfor
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Weight
                                                                    (Kg)</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        id="weight" name="weight"
                                                                        value="{{ old('weight', $applied_applicant->weight) }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Place of
                                                                    Birth</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        class="required" id="place_of_birth"
                                                                        placeholder="" name="place_of_birth"
                                                                        value="{{ old('place_of_birth', $applied_applicant->place_of_birth) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">National
                                                                    ID (Ghana Card)</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        class="required" id="national_identity_card"
                                                                        placeholder="" name="national_identity_card"
                                                                        value="{{ old('national_identity_card', $applied_applicant->national_identity_card) }}">
                                                                </div>
                                                                <label for="b-t-name" class="col-sm-2 col-form-label">Date
                                                                    of
                                                                    Birth</label>
                                                                <div class="col-sm-2">
                                                                    <div class="form-group fill">
                                                                        <input type="date" class="form-control"
                                                                            id="date_of_birth" name="date_of_birth"
                                                                            value="{{ old('date_of_birth', $applied_applicant->date_of_birth) }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Hometown</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control required"
                                                                        id="hometown" name="hometown"
                                                                        value="{{ old('hometown', $applied_applicant->hometown) }}">
                                                                </div>
                                                                <label for="district"
                                                                    class="col-sm-2 col-form-label">District</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control required" id="district"
                                                                        name="district">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $district)
                                                                            <option value="{{ $district->id }}"
                                                                                {{ old('district', $applied_applicant->district) == $district->id ? 'selected' : '' }}>
                                                                                {{ $district->district_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <label for="region" class="col-sm-2 col-form-label">Home
                                                                    Region</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control required" id="region"
                                                                        name="region">
                                                                        <option value="">Select Region</option>
                                                                        @foreach ($regions as $region)
                                                                            <option value="{{ $region->id }}"
                                                                                {{ old('region', $applied_applicant->region) == $region->id ? 'selected' : '' }}>
                                                                                {{ $region->region_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Telephone
                                                                    Number</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control required"
                                                                        id="contact" name="contact"
                                                                        value="{{ old('contact', $applied_applicant->contact) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Email
                                                                    Address</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control required"
                                                                        id="email" name="email"
                                                                        value="{{ old('email', $applied_applicant->email) }}">
                                                                </div>

                                                                <label for="b-t-name" class="col-sm-2 col-form-label">
                                                                    Employment Status</label>
                                                                <div class="col-sm-2">
                                                                    <select class="form-control required" id="employment"
                                                                        name="employment">
                                                                        <option value="">Choose option</option>
                                                                        <option value="EMPLOYED"
                                                                            {{ old('employment', $applied_applicant->employment) == 'EMPLOYED' ? 'selected' : '' }}>
                                                                            EMPLOYED</option>
                                                                        <option value="UNEMPLOYED"
                                                                            {{ old('employment', $applied_applicant->employment) == 'UNEMPLOYED' ? 'selected' : '' }}>
                                                                            UNEMPLOYED</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Residential
                                                                    Address</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        id="residential_address"
                                                                        name="residential_address"
                                                                        value="{{ old('residential_address', $applied_applicant->residential_address) }}">

                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Digital
                                                                    Address</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control"
                                                                        id="digital_address" name="digital_address"
                                                                        value="{{ old('digital_address', $applied_applicant->digital_address) }}">
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="languages"
                                                                        class="col-sm-2 col-form-label">Language(s)
                                                                        Spoken</label>
                                                                    <div class="col-sm-4">
                                                                        <select
                                                                            class="js-example-basic-multiple form-control"
                                                                            multiple="multiple" id="languages"
                                                                            name="language[]">
                                                                            @foreach ($ghanaian_languages as $language)
                                                                                <option value="{{ $language }}"
                                                                                    {{ in_array($language, old('language', $applied_applicant->language ?? [])) ? 'selected' : '' }}>
                                                                                    {{ $language }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <label for="sports_interest"
                                                                        class="col-sm-2 col-form-label">Sporting
                                                                        Interest</label>
                                                                    <div class="col-sm-4">
                                                                        <select
                                                                            class="js-example-basic-multiple form-control"
                                                                            id="sports_interest" name="sports_interest[]"
                                                                            multiple="multiple">
                                                                            @foreach ($sports_interests as $interest)
                                                                                <option value="{{ $interest }}"
                                                                                    {{ in_array($interest, old('sports_interest', $applied_applicant->sports_interest ?? [])) ? 'selected' : '' }}>
                                                                                    {{ $interest }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-primary save-btn"
                                                                style="float: right;" id="saveBioData">Next</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="b-w-tab2">
                                                <form id="form2" action="{{ route('saveEducationData') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mt-5">Basic Education details</h5>
                                                            <hr>
                                                            <div style="">
                                                                <div class="form-group row">
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">BECE
                                                                        Index Number</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text"
                                                                            class="form-control required"
                                                                            id="bece_index_number"
                                                                            name="bece_index_number"
                                                                            value="{{ old('bece_index_number', $applied_applicant->bece_index_number) }}">
                                                                    </div>
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">JHS
                                                                        Completion Year</label>
                                                                    <div class="col-sm-3">
                                                                        <div class="form-group fill">
                                                                            <input type="date" class="form-control"
                                                                                id="bece_year_completion"
                                                                                name="bece_year_completion"
                                                                                value="{{ old('bece_year_completion', $applied_applicant->bece_year_completion) }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">Upload
                                                                        JHS
                                                                        Certificate</label>
                                                                    <div class="col-sm-3">
                                                                        <div
                                                                            class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                            <i class="feather icon-paperclip"></i> Add
                                                                            Attachment
                                                                            <input type="file" name="bece_certificate"
                                                                                accept=".pdf" id="bece_certificate" />
                                                                        </div>
                                                                        {{-- <div id="file-preview" class="mt-2">
                                                                    @if ($applied_applicant->bece_certificate)
                                                                        <p>Selected file:
                                                                            {{ basename($applied_applicant->bece_certificate) }}
                                                                        </p>
                                                                        <a href="{{ asset($applied_applicant->bece_certificate) }}"
                                                                            target="_blank">View PDF</a>
                                                                    @endif
                                                                </div> --}}
                                                                        <div id="file-preview" class="mt-2">
                                                                            @if ($applied_applicant->bece_certificate)
                                                                                <p>Selected file:
                                                                                    {{ pathinfo($applied_applicant->bece_certificate, PATHINFO_FILENAME) }}.{{ pathinfo($applied_applicant->bece_certificate, PATHINFO_EXTENSION) }}
                                                                                </p>
                                                                                <a href="{{ asset($applied_applicant->bece_certificate) }}"
                                                                                    target="_blank">View PDF</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="mt-5">Secondary Education Details</h5>
                                                            <hr>
                                                            <div style="">
                                                                <div class="form-group row">
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">WASSCE
                                                                        Index
                                                                        Number(s)</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text"
                                                                            class="form-control required"
                                                                            id="wassce_index_number"
                                                                            name="wassce_index_number"
                                                                            value="{{ old('wassce_index_number', $applied_applicant->wassce_index_number) }}">
                                                                    </div>
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">SHS
                                                                        Completion Year</label>
                                                                    <div class="col-sm-3">
                                                                        <input class="form-control datepicker required"
                                                                            id="wassce_year_completion"
                                                                            name="wassce_year_completion" type="date"
                                                                            value="{{ old('wassce_year_completion', $applied_applicant->wassce_year_completion) }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">WASSCE
                                                                        Results Slip
                                                                        Number(s)</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text"
                                                                            class="form-control required"
                                                                            id="wassce_serial_number"
                                                                            name="wassce_serial_number"
                                                                            value="{{ old('wassce_serial_number', $applied_applicant->wassce_serial_number) }}">
                                                                    </div>

                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">Course
                                                                        Offerred</label>
                                                                    <div class="col-sm-3">
                                                                        <select class="form-control required"
                                                                            id="secondary_course_offered"
                                                                            name="secondary_course_offered">
                                                                            <option value="">Choose Course</option>
                                                                            <option value="GENERAL ARTS"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'GENERAL ARTS' ? 'selected' : '' }}>
                                                                                GENERAL ARTS</option>
                                                                            <option value="VISUAL ARTS"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'VISUAL ARTS' ? 'selected' : '' }}>
                                                                                VISUAL ARTS</option>
                                                                            <option value="BUSINESS"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'BUSINESS' ? 'selected' : '' }}>
                                                                                BUSINESS</option>
                                                                            <option value="SCIENCE"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'SCIENCE' ? 'selected' : '' }}>
                                                                                SCIENCE</option>
                                                                            <option value="HOME ECONOMICS"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'HOME ECONOMICS' ? 'selected' : '' }}>
                                                                                HOME ECONOMICS</option>
                                                                            <option value="VOCATIONAL SKILL"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'VOCATIONAL SKILL' ? 'selected' : '' }}>
                                                                                VOCATIONAL SKILL</option>
                                                                            <option value="AGRICULTURAL SCIENCE"
                                                                                {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == 'AGRICULTURAL SCIENCE' ? 'selected' : '' }}>
                                                                                AGRICULTURAL SCIENCE</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="form-group row">

                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">Name
                                                                        of SHS</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text"
                                                                            class="form-control required"
                                                                            id="name_of_secondary_school"
                                                                            name="name_of_secondary_school"
                                                                            value="{{ old('name_of_secondary_school', $applied_applicant->name_of_secondary_school) }}">
                                                                    </div>
                                                                    <label for="b-t-name"
                                                                        class="col-sm-3 col-form-label">Upload
                                                                        SHS
                                                                        Certificate</label>
                                                                    <div class="col-sm-3">
                                                                        <div
                                                                            class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                            <i class="feather icon-paperclip"></i> Add
                                                                            Attachment
                                                                            <input type="file"
                                                                                name="wassce_certificate" accept=".pdf"
                                                                                id="wassce_certificate" />
                                                                        </div>
                                                                        <div id="wassce-file-preview" class="mt-2">
                                                                            @if (!empty($applied_applicant->wassce_certificate))
                                                                                <p>Selected file:
                                                                                    {{ basename($applied_applicant->wassce_certificate) }}
                                                                                </p>
                                                                                <a href="{{ asset($applied_applicant->wassce_certificate) }}"
                                                                                    target="_blank">View PDF</a>
                                                                            @endif
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <h5 class="mt-5">Select Best Six (6) BECE Grades</h5>
                                                            <hr>
                                                            <div style="text-align: right; margin-left:0.5cm">
                                                                <!-- BECE English -->
                                                                <div class="form-group row">
                                                                    <select id="bece_english" name="bece_english"
                                                                        class="col-sm-6 required">
                                                                        <option value="ENGLISH LANGUAGE"
                                                                            {{ old('bece_english', $applied_applicant->bece_english) == 'ENGLISH LANGUAGE' ? 'selected' : '' }}>
                                                                            ENGLISH LANGUAGE
                                                                        </option>
                                                                    </select>

                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_english_grade"
                                                                            name="bece_subject_english_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option
                                                                                    value="{{ $grade->beceresults }}"{{ old('bece_subject_english_grade', $applied_applicant->bece_subject_english_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- BECE Maths -->
                                                                <div class="form-group row">
                                                                    <select id="bece_mathematics" name="bece_mathematics"
                                                                        class="col-sm-6 required">
                                                                        <option value="MATHEMATICS"
                                                                            {{ old('bece_mathematics', $applied_applicant->bece_mathematics) == 'MATHEMATICS' ? 'selected' : '' }}>
                                                                            MATHEMATICS
                                                                        </option>
                                                                    </select>

                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_maths_grade"
                                                                            name="bece_subject_maths_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}"
                                                                                    {{ old('bece_subject_maths_grade', $applied_applicant->bece_subject_maths_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- BECE Subject 1 -->
                                                                <div class="form-group row">
                                                                    <select id="bece_subject_three"
                                                                        name="bece_subject_three"class="col-sm-6 required">
                                                                        <option value="" selected="selected">Select
                                                                            Subject</option>
                                                                        @foreach ($bece_subject as $subject)
                                                                            <option value="{{ $subject->becesubjects }}"
                                                                                {{ old('bece_subject_three', $applied_applicant->bece_subject_three) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->becesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_three_grade"
                                                                            name="bece_subject_three_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option
                                                                                    value="{{ $grade->beceresults }}"{{ old('bece_subject_three_grade', $applied_applicant->bece_subject_three_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- BECE Subject 2 -->
                                                                <div class="form-group row">
                                                                    <select id="bece_subject_four"
                                                                        name="bece_subject_four"
                                                                        class="col-sm-6 required">
                                                                        <option value="" selected="selected">Select
                                                                            Subject</option>
                                                                        @foreach ($bece_subject as $subject)
                                                                            <option value="{{ $subject->becesubjects }}"
                                                                                {{ old('bece_subject_four', $applied_applicant->bece_subject_four) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->becesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_four_grade"
                                                                            name="bece_subject_four_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}"
                                                                                    {{ old('bece_subject_four_grade', $applied_applicant->bece_subject_four_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- BECE Subject 3 -->
                                                                <div class="form-group row">
                                                                    <select id="bece_subject_five"
                                                                        name="bece_subject_five"
                                                                        class="col-sm-6 required">
                                                                        <option value="" selected="selected">Select
                                                                            Subject</option>
                                                                        @foreach ($bece_subject as $subject)
                                                                            <option value="{{ $subject->becesubjects }}"
                                                                                {{ old('bece_subject_five', $applied_applicant->bece_subject_five) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->becesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_five_grade"
                                                                            name="bece_subject_five_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}"
                                                                                    {{ old('bece_subject_five_grade', $applied_applicant->bece_subject_five_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- BECE Subject 4 -->
                                                                <div class="form-group row">
                                                                    <select id="bece_subject_six" name="bece_subject_six"
                                                                        class="col-sm-6 required">
                                                                        <option value="" selected="selected">Select
                                                                            Subject</option>
                                                                        @foreach ($bece_subject as $subject)
                                                                            <option value="{{ $subject->becesubjects }}"
                                                                                {{ old('bece_subject_six', $applied_applicant->bece_subject_six) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->becesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="col-sm-3">
                                                                        <select id="bece_subject_six_grade"
                                                                            name="bece_subject_six_grade"
                                                                            class="form-control required">
                                                                            <option value="">Select Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}"
                                                                                    {{ old('bece_subject_six_grade', $applied_applicant->bece_subject_six_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <h5 class="mt-5">Select Best Six (6) WASSCE Grades</h5>
                                                            <hr>
                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_one" name="exam_type_one"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_one', $applied_applicant->exam_type_one) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_one', $applied_applicant->exam_type_one) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_one', $applied_applicant->exam_type_one) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_english" name="wassce_english"
                                                                        class="form-control required">
                                                                        <option value="ENGLISH LANGUAGE"
                                                                            {{ old('wassce_english', $applied_applicant->wassce_english) == 'ENGLISH LANGUAGE' ? 'selected' : '' }}>
                                                                            ENGLISH LANGUAGE</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_english_grade"
                                                                        name="wassce_subject_english_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_english_grade', $applied_applicant->wassce_subject_english_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_one"
                                                                        name="results_slip_one" class="form-control"
                                                                        value="{{ old('results_slip_one', $applied_applicant->results_slip_one) }}"
                                                                        placeholder="Results Slip Number(s)">
                                                                    <input type="checkbox" id="check_same"
                                                                        name="check_same" class="ml-2"> Same as above
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_two" name="exam_type_two"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_two', $applied_applicant->exam_type_two) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_two', $applied_applicant->exam_type_two) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_two', $applied_applicant->exam_type_two) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_mathematics"
                                                                        name="wassce_mathematics"
                                                                        class="form-control required">
                                                                        <option value="CORE MATHEMATICS"
                                                                            {{ old('wassce_mathematics', $applied_applicant->wassce_mathematics) == 'CORE MATHEMATICS' ? 'selected' : '' }}>
                                                                            CORE MATHEMATICS
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_maths_grade"
                                                                        name="wassce_subject_maths_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_maths_grade', $applied_applicant->wassce_subject_maths_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_two"
                                                                        id="results_slip_two" name="results_slip_two"
                                                                        class="form-control"
                                                                        value="{{ old('results_slip_two', $applied_applicant->results_slip_two) }}"
                                                                        placeholder="Results Slip Number(s)">

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_three" name="exam_type_three"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_three', $applied_applicant->exam_type_three) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_three', $applied_applicant->exam_type_three) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_three', $applied_applicant->exam_type_three) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_three"
                                                                        name="wassce_subject_three"
                                                                        class="form-control required">
                                                                        <option value="">Select Subject</option>
                                                                        @foreach ($wassce_subject as $subject)
                                                                            <option
                                                                                value="{{ $subject->wasscesubjects }}"
                                                                                {{ old('wassce_subject_three', $applied_applicant->wassce_subject_three) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->wasscesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_three_grade"
                                                                        name="wassce_subject_three_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_three_grade', $applied_applicant->wassce_subject_three_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_three"
                                                                        name="results_slip_three" class="form-control"
                                                                        value="{{ old('results_slip_three', $applied_applicant->results_slip_three) }}"
                                                                        placeholder="Results Slip Number(s)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_four" name="exam_type_four"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_four', $applied_applicant->exam_type_four) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_four', $applied_applicant->exam_type_four) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_four', $applied_applicant->exam_type_four) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_four"
                                                                        name="wassce_subject_four"
                                                                        class="form-control required">
                                                                        <option value="">Select Subject</option>
                                                                        @foreach ($wassce_subject as $subject)
                                                                            <option
                                                                                value="{{ $subject->wasscesubjects }}"
                                                                                {{ old('wassce_subject_four', $applied_applicant->wassce_subject_four) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->wasscesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_four_grade"
                                                                        name="wassce_subject_four_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_four_grade', $applied_applicant->wassce_subject_four_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_four"
                                                                        name="results_slip_four" class="form-control"
                                                                        value="{{ old('results_slip_four', $applied_applicant->results_slip_four) }}"
                                                                        placeholder="Results Slip Number(s)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_five" name="exam_type_five"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_five', $applied_applicant->exam_type_five) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_five', $applied_applicant->exam_type_five) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_five', $applied_applicant->exam_type_five) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_five"
                                                                        name="wassce_subject_five"
                                                                        class="form-control required">
                                                                        <option value="">Select Subject</option>
                                                                        @foreach ($wassce_subject as $subject)
                                                                            <option
                                                                                value="{{ $subject->wasscesubjects }}"
                                                                                {{ old('wassce_subject_five', $applied_applicant->wassce_subject_five) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->wasscesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_five_grade"
                                                                        name="wassce_subject_five_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_five_grade', $applied_applicant->wassce_subject_five_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_five"
                                                                        name="results_slip_five" class="form-control"
                                                                        value="{{ old('results_slip_five', $applied_applicant->results_slip_five) }}"
                                                                        placeholder="Results Slip Number(s)">

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-3">
                                                                    <select id="exam_type_six" name="exam_type_six"
                                                                        class="form-control required">
                                                                        <option value="" selected="selected">Select
                                                                            Exam
                                                                            Type</option>
                                                                        <option value="WASSCE"
                                                                            {{ old('exam_type_six', $applied_applicant->exam_type_six) == 'WASSCE' ? 'selected' : '' }}>
                                                                            WASSCE</option>
                                                                        <option value="PRIVATE"
                                                                            {{ old('exam_type_six', $applied_applicant->exam_type_six) == 'PRIVATE' ? 'selected' : '' }}>
                                                                            PRIVATE</option>
                                                                        <option value="A LEVEL"
                                                                            {{ old('exam_type_six', $applied_applicant->exam_type_six) == 'A LEVEL' ? 'selected' : '' }}>
                                                                            A LEVEL</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_six"
                                                                        name="wassce_subject_six"
                                                                        class="form-control required">
                                                                        <option value="">Select Subject</option>
                                                                        @foreach ($wassce_subject as $subject)
                                                                            <option
                                                                                value="{{ $subject->wasscesubjects }}"
                                                                                {{ old('wassce_subject_six', $applied_applicant->wassce_subject_six) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                                {{ $subject->wasscesubjects }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select id="wassce_subject_six_grade"
                                                                        name="wassce_subject_six_grade"
                                                                        class="form-control required">
                                                                        <option value="">Select Grade</option>
                                                                        @foreach ($wassce_results as $grade)
                                                                            <option value="{{ $grade->wassceresult }}"
                                                                                {{ old('wassce_subject_six_grade', $applied_applicant->wassce_subject_six_grade) == $grade->wassceresult ? 'selected' : '' }}>
                                                                                {{ $grade->wassceresult }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" id="results_slip_six"
                                                                        name="results_slip_six" class="form-control"
                                                                        value="{{ old('results_slip_six', $applied_applicant->results_slip_six) }}"
                                                                        placeholder="Results Slip Number(s)">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <h5 class="mt-12">Tertiary Education details</h5>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="b-t-name"
                                                                            class="col-sm-2 col-form-label">Name
                                                                            of Institution</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="text"
                                                                                class="form-control required"
                                                                                id="name_of_tertiary"
                                                                                name="name_of_tertiary"
                                                                                value="{{ old('name_of_tertiary', $applied_applicant->name_of_tertiary) }}">
                                                                        </div>
                                                                        <label for="b-t-name"
                                                                            class="col-sm-2 col-form-label">Qualification</label>
                                                                        <div class="col-sm-2">
                                                                            <select id="tertiary_qualification"
                                                                                name="tertiary_qualification"
                                                                                class="form-control required">
                                                                                <option value="BSc."
                                                                                    {{ old('tertiary_qualification', $applied_applicant->tertiary_qualification) == 'BSc.' ? 'selected' : '' }}>
                                                                                    BSc.
                                                                                </option>
                                                                                <option value="BA."
                                                                                    {{ old('tertiary_qualification', $applied_applicant->tertiary_qualification) == 'BA.' ? 'selected' : '' }}>
                                                                                    BA.
                                                                                </option>
                                                                                <option value="BEng."
                                                                                    {{ old('tertiary_qualification', $applied_applicant->tertiary_qualification) == 'BEng.' ? 'selected' : '' }}>
                                                                                    BEng.
                                                                                </option>
                                                                                <option value="LLB."
                                                                                    {{ old('tertiary_qualification', $applied_applicant->tertiary_qualification) == 'LLB.' ? 'selected' : '' }}>
                                                                                    LLB.
                                                                                </option>

                                                                            </select>

                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <select id="programme" name="programme"
                                                                                class="form-control required">
                                                                                <option value="">CHOOSE PROGRAMME
                                                                                </option>
                                                                                <option value="COMPUTER SCIENCE"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'COMPUTER SCIENCE' ? 'selected' : '' }}>
                                                                                    COMPUTER SCIENCE
                                                                                </option>
                                                                                <option value="BUSINESS ADMINISTRATION"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'BUSINESS ADMINISTRATION' ? 'selected' : '' }}>
                                                                                    BUSINESS ADMINISTRATION
                                                                                </option>
                                                                                <option value="MECHANICAL ENGINEERING"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'MECHANICAL ENGINEERING' ? 'selected' : '' }}>
                                                                                    MECHANICAL ENGINEERING
                                                                                </option>
                                                                                <option value="ELECTRICAL ENGINEERING"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'ELECTRICAL ENGINEERING' ? 'selected' : '' }}>
                                                                                    ELECTRICAL ENGINEERING
                                                                                </option>
                                                                                <option value="CIVIL ENGINEERING"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'CIVIL ENGINEERING' ? 'selected' : '' }}>
                                                                                    CIVIL ENGINEERING
                                                                                </option>
                                                                                <option value="LAW"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'LAW' ? 'selected' : '' }}>
                                                                                    LAW
                                                                                </option>
                                                                                <option value="MEDICINE"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'MEDICINE' ? 'selected' : '' }}>
                                                                                    MEDICINE
                                                                                </option>
                                                                                <option value="PHARMACY"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'PHARMACY' ? 'selected' : '' }}>
                                                                                    PHARMACY
                                                                                </option>
                                                                                <option value="NURSING"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'NURSING' ? 'selected' : '' }}>
                                                                                    NURSING
                                                                                </option>
                                                                                <option value="ARCHITECTURE"
                                                                                    {{ old('programme', $applied_applicant->programme) == 'ARCHITECTURE' ? 'selected' : '' }}>
                                                                                    ARCHITECTURE
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <label for="b-t-name"
                                                                            class="col-sm-3 col-form-label">Class
                                                                            Attained</label>
                                                                        <div class="col-sm-3">
                                                                            <select id="class_attained"
                                                                                name="class_attained"
                                                                                class="form-control required">
                                                                                <option value="">Choose option
                                                                                </option>
                                                                                <option value="FIRST CLASS"
                                                                                    {{ old('class_attained', $applied_applicant->class_attained) == 'FIRST CLASS' ? 'selected' : '' }}>
                                                                                    FIRST CLASS</option>
                                                                                <option
                                                                                    value="SECOND CLASS (UPPER DIVISION)"
                                                                                    {{ old('class_attained', $applied_applicant->class_attained) == 'SECOND CLASS (UPPER DIVISION)' ? 'selected' : '' }}>
                                                                                    SECOND CLASS (UPPER DIVISION)</option>
                                                                                <option
                                                                                    value="SECOND CLASS (LOWER DIVISION)"
                                                                                    {{ old('class_attained', $applied_applicant->class_attained) == 'SECOND CLASS (LOWER DIVISION)' ? 'selected' : '' }}>
                                                                                    SECOND CLASS (LOWER DIVISION)</option>

                                                                            </select>
                                                                        </div>
                                                                        <label for="b-t-name"
                                                                            class="col-sm-3 col-form-label">Year
                                                                            of Completion</label>
                                                                        <div class="col-sm-3">
                                                                            <input type="date" id="higherCompletion"
                                                                                name="year_of_completion"
                                                                                class="form-control required"
                                                                                value="{{ old('year_of_completion', $applied_applicant->year_of_completion) }}">
                                                                        </div>
                                                                        <label for="b-t-name"
                                                                            class="col-sm-2 col-form-label">Upload
                                                                            Certificate</label>
                                                                        <div class="col-sm-3">
                                                                            <div
                                                                                class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                                <i class="feather icon-paperclip"></i> Add
                                                                                Attachment
                                                                                <input type="file"
                                                                                    id="degree_certificate" accept=".pdf"
                                                                                    name="degree_certificate" />
                                                                            </div>
                                                                            <div id="degree-file-preview" class="mt-2">
                                                                                @if (!empty($applied_applicant->degree_certificate))
                                                                                    <p>Selected file:
                                                                                        {{ basename($applied_applicant->degree_certificate) }}
                                                                                    </p>
                                                                                    <a href="{{ asset($applied_applicant->degree_certificate) }}"
                                                                                        target="_blank">View PDF</a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <button type="submit" class="btn btn-primary save-btn"
                                                                id="saveEducationData" style="float: right;">Next</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="b-w-tab3">
                                                <form id="form3" action="{{ route('saveProfessionalData') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <h5 class="mt-12" style="text-align: left">Professional
                                                            Qualification
                                                            details</h5>
                                                        <hr>
                                                        <div style="">
                                                            <div class="form-group row">
                                                                <label for="b-t-name" class="col-sm-2 col-form-label">Name
                                                                    of
                                                                    Institution</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control required"
                                                                        id="name_of_professional_school"
                                                                        name="name_of_professional_school"
                                                                        value="{{ old('name_of_professional_school', $applied_applicant->name_of_professional_school) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Programme</label>
                                                                <div class="col-sm-1">
                                                                    <select id="professional_programme"
                                                                        name="professional_programme"
                                                                        class="form-control required">
                                                                        <option value="">Select Option</option>
                                                                        <option
                                                                            value="MBChB."{{ old('professional_programme', $applied_applicant->professional_programme) == 'MBChB.' ? 'selected' : '' }}>
                                                                            MBChB.
                                                                        </option>
                                                                        <option value="MSc."
                                                                            {{ old('professional_programme', $applied_applicant->professional_programme) == 'MSc.' ? 'selected' : '' }}>
                                                                            MSc.
                                                                        </option>
                                                                        <option value="MA."
                                                                            {{ old('professional_programme', $applied_applicant->professional_programme) == 'MA.' ? 'selected' : '' }}>
                                                                            MA.
                                                                        </option>
                                                                        <option value="MEng."
                                                                            {{ old('professional_programme', $applied_applicant->professional_programme) == 'MEng.' ? 'selected' : '' }}>
                                                                            MEng.
                                                                        </option>
                                                                        <option value="PhD."
                                                                            {{ old('professional_programme', $applied_applicant->professional_programme) == 'PhD.' ? 'selected' : '' }}>
                                                                            PhD.
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <select id="professional_qualification"
                                                                        name="professional_qualification"
                                                                        class="form-control required">
                                                                        <option value="">CHOOSE
                                                                            professional_qualification
                                                                        </option>
                                                                        <option value="COMPUTER SCIENCE"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'COMPUTER SCIENCE' ? 'selected' : '' }}>
                                                                            COMPUTER SCIENCE
                                                                        </option>
                                                                        <option value="BUSINESS ADMINISTRATION"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'BUSINESS ADMINISTRATION' ? 'selected' : '' }}>
                                                                            BUSINESS ADMINISTRATION
                                                                        </option>
                                                                        <option value="MECHANICAL ENGINEERING"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'MECHANICAL ENGINEERING' ? 'selected' : '' }}>
                                                                            MECHANICAL ENGINEERING
                                                                        </option>
                                                                        <option value="ELECTRICAL ENGINEERING"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'ELECTRICAL ENGINEERING' ? 'selected' : '' }}>
                                                                            ELECTRICAL ENGINEERING
                                                                        </option>
                                                                        <option value="CIVIL ENGINEERING"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'CIVIL ENGINEERING' ? 'selected' : '' }}>
                                                                            CIVIL ENGINEERING
                                                                        </option>
                                                                        <option value="LAW"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'LAW' ? 'selected' : '' }}>
                                                                            LAW
                                                                        </option>
                                                                        <option value="MEDICINE"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'MEDICINE' ? 'selected' : '' }}>
                                                                            MEDICINE
                                                                        </option>
                                                                        <option value="PHARMACY"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'PHARMACY' ? 'selected' : '' }}>
                                                                            PHARMACY
                                                                        </option>
                                                                        <option value="NURSING"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'NURSING' ? 'selected' : '' }}>
                                                                            NURSING
                                                                        </option>
                                                                        <option value="ARCHITECTURE"
                                                                            {{ old('professional_qualification', $applied_applicant->professional_qualification) == 'ARCHITECTURE' ? 'selected' : '' }}>
                                                                            ARCHITECTURE
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <label for="b-t-name" class="col-sm-2 col-form-label">Year
                                                                    of
                                                                    Completion</label>
                                                                <div class="col-sm-1">
                                                                    <input type="date" class="form-control required"
                                                                        name="year_of_professional_completion"
                                                                        value="{{ old('year_of_professional_completion', $applied_applicant->year_of_professional_completion) }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Years of
                                                                    Experience</label>
                                                                <div class="col-sm-2">
                                                                    <select
                                                                        id="year_of_professional_experience"name="year_of_professional_experience"
                                                                        class="form-control required">
                                                                        <option value="">select option</option>
                                                                        <option value="1"
                                                                            {{ old('year_of_professional_experience', $applied_applicant->year_of_professional_experience) == '1' ? 'selected' : '' }}>
                                                                            1
                                                                        </option>
                                                                        <option value="2"
                                                                            {{ old('year_of_professional_experience', $applied_applicant->year_of_professional_experience) == '2' ? 'selected' : '' }}>
                                                                            2
                                                                        </option>
                                                                        <option value="3"
                                                                            {{ old('year_of_professional_experience', $applied_applicant->year_of_professional_experience) == '3' ? 'selected' : '' }}>
                                                                            3
                                                                        </option>
                                                                        <option value="4"
                                                                            {{ old('year_of_professional_experience', $applied_applicant->year_of_professional_experience) == '4' ? 'selected' : '' }}>
                                                                            4
                                                                        </option>
                                                                        <option value="5 YEARS AND ABOVE"
                                                                            {{ old('year_of_professional_experience', $applied_applicant->year_of_professional_experience) == '5 YEARS AND ABOVEA' ? 'selected' : '' }}>
                                                                            5 YEARS AND ABOVEA
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">PIN/AIN/HIN/Certificate
                                                                    Number</label>
                                                                <div class="col-sm-2">
                                                                    <input type="text" class="form-control required"
                                                                        id="pin_id" name="pin_number"
                                                                        value="{{ old('pin_number', $applied_applicant->pin_number) }}">
                                                                </div>
                                                                <label for="b-t-name"
                                                                    class="col-sm-2 col-form-label">Upload
                                                                    Certificate</label>
                                                                <div class="col-sm-2">
                                                                    <div
                                                                        class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                        <i class="feather icon-paperclip"></i> Add
                                                                        Attachment
                                                                        <input type="file"
                                                                            name="professional_certificate" accept=".pdf"
                                                                            id="professional_certificate" />
                                                                    </div>
                                                                    <div id="professional-file-preview" class="mt-2">
                                                                        @if (!empty($applied_applicant->professional_certificate))
                                                                            <p>Selected file:
                                                                                {{ basename($applied_applicant->professional_certificate) }}
                                                                            </p>
                                                                            <a href="{{ asset($applied_applicant->professional_certificate) }}"
                                                                                target="_blank">View PDF</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary save-btn"
                                                            id="saveProfessionalData" style="float:right;">Next</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="b-w-tab4">
                                                <div class="text-center">
                                                    <div class="alert alert-danger" role="alert">
                                                        <h5>Carefully review the information you provided below. Once
                                                            submitt it cannot be changed.</h5>
                                                    </div>
                                                    <hr>
                                                    <h4 class="text-center"
                                                        style="font-weight: bolder;text-transform: uppercase; margin-top: 20px; margin-bottom: 20px;">
                                                        Details of Application
                                                    </h4>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <td>
                                                                @if (file_exists($imagePath))
                                                                    <img id="showImage"
                                                                        src="{{ asset($applied_applicant->applicant_image) }}"
                                                                        alt="" width="200px"
                                                                        class="img-thumbnail">
                                                                @else
                                                                    <img id="showImage"
                                                                        src="{{ asset('assets/images/img_placeholder_avatar.jpg') }}"
                                                                        alt="" width="200px"
                                                                        class="img-thumbnail">
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
                                                                                VACANCY SELECTED: ARM OF SERVICE:
                                                                                {{ $applied_applicant->arm_of_service }}/
                                                                                COMMISSION
                                                                                TYPE:{{ $applied_applicant->commission_type }}/
                                                                                BRANCH:{{ $applied_applicant->branches->branch ?? 'N/A' }}
                                                                            </b>
                                                                        </h5>
                                                                        <span></span>
                                                                        <h5 class="mt-5"
                                                                            style="text-transform: uppercase; text-align:left; margin-left: 0.5cm">
                                                                            Biodata details</h5>
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Surname</th>
                                                                                    <th>Other Name(s)</th>
                                                                                    <th>Sex</th>
                                                                                    <th>Marital Status</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-surname">
                                                                                            {{ $applied_applicant->surname }}
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
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Height</th>
                                                                                    <th>Weight</th>
                                                                                    <th>Place of birth</th>
                                                                                    <th>Date of Birth</th>
                                                                                    <th>Hometown</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-height">
                                                                                            {{ $applied_applicant->height }}
                                                                                        </td>
                                                                                        <td id="preview-weight">
                                                                                            {{ $applied_applicant->weight }}
                                                                                        </td>
                                                                                        <td id="preview-place-of-birth">
                                                                                            {{ $applied_applicant->place_of_birth }}
                                                                                        </td>
                                                                                        <td id="preview-date-of-birth">
                                                                                            {{ \Carbon\Carbon::parse($applied_applicant->date_of_birth)->format('d M, Y') }}
                                                                                        </td>
                                                                                        <td id="preview-hometown">
                                                                                            {{ $applied_applicant->hometown }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Home District</th>
                                                                                    <th>Home Region</th>
                                                                                    <th>Mobile</th>
                                                                                    <th>Email</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-district">
                                                                                            {{ $applied_applicant->districts->district_name ?? 'N/A' }}
                                                                                        </td>
                                                                                        <td id="preview-region">
                                                                                            {{ $applied_applicant->regions->region_name ?? 'N/A' }}
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
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Current Employment</th>
                                                                                    <th>Residential Address</th>
                                                                                    <th>Language(s) Spoken </th>
                                                                                    <th>Sports Interest</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td id="preview-employment">
                                                                                            {{ $applied_applicant->employment }}
                                                                                        </td>
                                                                                        <td
                                                                                            id="preview-residential-address">
                                                                                            {{ $applied_applicant->residential_address }}
                                                                                        </td>
                                                                                        <td id="preview-languages">
                                                                                            @php
                                                                                                $languages = is_string(
                                                                                                    $applied_applicant->language,
                                                                                                )
                                                                                                    ? json_decode(
                                                                                                        $applied_applicant->language,
                                                                                                        true,
                                                                                                    )
                                                                                                    : $applied_applicant->language;
                                                                                            @endphp
                                                                                            {{ implode(', ', $languages ?? []) }}
                                                                                        </td>
                                                                                        <td id="preview-sports-interests">
                                                                                            @php
                                                                                                $sportsInterests = is_string(
                                                                                                    $applied_applicant->sports_interest,
                                                                                                )
                                                                                                    ? json_decode(
                                                                                                        $applied_applicant->sports_interest,
                                                                                                        true,
                                                                                                    )
                                                                                                    : $applied_applicant->sports_interest;
                                                                                            @endphp
                                                                                            {{ implode(', ', $sportsInterests ?? []) }}
                                                                                        </td>
                                                                                    </tr>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <h5 class="mt-5"
                                                                            style="text-transform: uppercase; text-align:left; margin-left: 0.5cm">
                                                                            Educational details</h5>
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
                                                                                            {{ $applied_applicant->bece_index_number }}
                                                                                        </td>
                                                                                        <td
                                                                                            id="preview-jhs-completion-year">
                                                                                            {{ \Carbon\Carbon::parse($applied_applicant->bece_year_completion)->format('d M, Y') }}
                                                                                        </td>
                                                                                        <td id="wassce_index_number">
                                                                                            {{ $applied_applicant->wassce_index_number }}
                                                                                        </td>
                                                                                        <td id="wassce_year_completion">
                                                                                            {{ \Carbon\Carbon::parse($applied_applicant->wassce_year_completion)->format('d M, Y') }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Results Slip Number</th>
                                                                                    <th>School Name</th>
                                                                                    <th>Course Offered</th>
                                                                                    <th>-</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td
                                                                                            id="preview-shs-completion-year">
                                                                                            {{ $applied_applicant->wassce_serial_number }}
                                                                                        </td>
                                                                                        <td id="preview-shs-name">
                                                                                            {{ $applied_applicant->name_of_secondary_school }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->secondary_course_offered }}
                                                                                        </td>
                                                                                        <td>
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
                                                                                    <th>WASSCE Subjects</th>
                                                                                    <th>Grades</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <select id="bece_english"
                                                                                                class="form-control col-sm-12 required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_english }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_maths"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_mathematics }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub1"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_three }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub2"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_four }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub3"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_five }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub4"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_six }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select id="bece_english_grade"
                                                                                                name="bece_english_grade"
                                                                                                class="form-control required"
                                                                                                readonly>
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_english_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_maths_grade"
                                                                                                name="bece_maths_grade"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_maths_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub1"
                                                                                                name="bece_sub1"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_three_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub2"
                                                                                                name="bece_sub2"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_four_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub3"
                                                                                                name="bece_sub3"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_five_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="bece_sub4"
                                                                                                name="bece_sub4"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->bece_subject_six_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select id="bece_english"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_english }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_maths"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_mathematics }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub1"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_three }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub2"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_four }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub3"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_five }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub4"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_six }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select
                                                                                                id="wassce_english_grade"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_english_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_maths_grade"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_maths_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub1"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_three_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub2"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_four_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub3"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_five_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                            <select id="wassce_sub4"
                                                                                                class="form-control required">
                                                                                                <option>
                                                                                                    {{ $applied_applicant->wassce_subject_six_grade }}
                                                                                                </option>
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Name of Institution</th>
                                                                                    <th>Qualification</th>
                                                                                    <th>Year of Completion</th>
                                                                                    <th>Class Attained</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{ $applied_applicant->name_of_tertiary }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->tertiary_qualification }}
                                                                                            {{ $applied_applicant->programme }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ \Carbon\Carbon::parse($applied_applicant->year_of_completion)->format('d M, Y') }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->class_attained }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <h5 class="mt-5"
                                                                            style="text-transform: uppercase; text-align:left; margin-left: 0.5cm">
                                                                            Professional details</h5>
                                                                        <div class="row"
                                                                            style="margin-left: 0.5cm; margin-right: 0.5cm;">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Name of Institution</th>
                                                                                    <th>Qualification</th>
                                                                                    <th>Year of Completion</th>
                                                                                    <th>Years of Experience</th>
                                                                                    <th>PIN/AIN/HIN/Certificate Number</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{ $applied_applicant->name_of_professional_school }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->professional_programme }}
                                                                                            {{ $applied_applicant->professional_qualification }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ \Carbon\Carbon::parse($applied_applicant->year_of_professional_completion)->format('d M, Y') }}
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->year_of_professional_experience }}
                                                                                            YEAR(S)
                                                                                        </td>
                                                                                        <td>
                                                                                            {{ $applied_applicant->pin_number }}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div style="">
                                                                            <div class="form-group row">
                                                                                <div class="col-md-12">
                                                                                    <h5 class="mt-12" style="color: red">
                                                                                        Applicant Declaration</h5>
                                                                                    <hr>
                                                                                    <form
                                                                                        action="{{ route('AcceptanceOfForm') }}"
                                                                                        method="POST">
                                                                                        @csrf
                                                                                        <div
                                                                                            class="custom-control custom-checkbox">
                                                                                            <input type="checkbox"
                                                                                                class="custom-control-input"
                                                                                                id="customCheck1"
                                                                                                name="final_checked"
                                                                                                value="yes">
                                                                                            @error('final_checked')
                                                                                                <span
                                                                                                    class="badge badge-danger">{{ $message }}</span>
                                                                                            @enderror
                                                                                            <label
                                                                                                class="custom-control-label required"
                                                                                                for="customCheck1">
                                                                                                I <b>{{ $applied_applicant->surname }}
                                                                                                    {{ $applied_applicant->other_names }}</b>
                                                                                                declare that all the
                                                                                                information
                                                                                                given on this form are
                                                                                                correct
                                                                                                to
                                                                                                the best of my knowledge and
                                                                                                understand that <span
                                                                                                    class="text-danger">any
                                                                                                    false
                                                                                                    statement or omission
                                                                                                    may be
                                                                                                    liable for
                                                                                                    prosecution.</span>
                                                                                            </label>
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
                @elseif ($applied_applicant->final_checked == 'YES' && $applied_applicant->qualification == 'QUALIFIED')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('assets/images/pages/medal-gold.svg') }}" alt=""
                                        class="img-fluid w-50" style="height:350px;width:400px;">
                                    <h4 class="mt-3">$6.99 GOLD</h4>
                                    <p class="mb-2">This is 90 days basic membership</p>
                                    <p><span class="badge badge-primary">26 Sales</span> </p>
                                    <hr>
                                    <button type="button" class="btn btn-icon btn-outline-primary mr-2"
                                        data-toggle="modal" data-target="#modal-report"><i
                                            class="feather icon-edit-2"></i></button>
                                    <button type="button" class="btn btn-icon btn-outline-danger"><i
                                            class="feather icon-trash-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif ($applied_applicant->final_checked == 'YES' && $applied_applicant->qualification == 'DISQUALIFIED')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="{{ asset('assets/images/pages/medal-silver.svg') }}" alt=""
                                        class="img-fluid w-50" style="height:350px;width:400px;">
                                    <h4 class="mt-3">{{ $applied_applicant->qualification }}</h4>
                                    <p class="mb-2">{{ $applied_applicant->disqualification_reason }}</p>
                                    <hr>
                                    <h2><span class="badge badge-primary"><a href="#" class="text-white">Print
                                                PDF</a></span> </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </section>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Required Js -->
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

    {{-- <script>
        $(document).ready(function() {
            // Handle form submission for Bio Data
            $('#form1').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Refresh the form content (if needed)
                        $('#form1').trigger('reset');
                        // Move to the next tab
                        $('a[href="#b-w-tab2"]').tab('show');
                        // Optionally update progress bar
                        // $('#bar .progress-bar').css('width', '33%');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle form submission for Educational Data
            $('#form2').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Refresh the form content (if needed)
                        $('#form2').trigger('reset');
                        // Move to the next tab
                        $('a[href="#b-w-tab3"]').tab('show');
                        // Optionally update progress bar
                        // $('#bar .progress-bar').css('width', '66%');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle form submission for Professional Data
            $('#form3').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Refresh the form content (if needed)
                        $('#form3').trigger('reset');
                        // Move to the preview tab
                        $('a[href="#b-w-tab4"]').tab('show');
                        // Optionally update progress bar
                        // $('#bar .progress-bar').css('width', '100%');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Function to activate the correct tab
            function activateTab(tab) {
                $('.nav-link').removeClass('active'); // Remove 'active' class from all tabs
                $('.tab-pane').removeClass('active').removeClass(
                    'show'); // Remove 'active' and 'show' class from all tab panes
                $('a[href="#' + tab + '"]').addClass('active'); // Add 'active' class to the current tab link
                $('#' + tab).addClass('active show'); // Add 'active' and 'show' class to the current tab pane
            }

            // Handle form submission for Bio Data
            $('#form1').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Redirect to the next tab
                        window.location.href = window.location.pathname + '?tab=b-w-tab2';
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle form submission for Educational Data
            $('#form2').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Redirect to the next tab
                        window.location.href = window.location.pathname + '?tab=b-w-tab3';
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Handle form submission for Professional Data
            $('#form3').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Redirect to the preview tab
                        window.location.href = window.location.pathname + '?tab=b-w-tab4';
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            // On page load, move to the appropriate tab based on query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const activeTab = urlParams.get('tab');
            if (activeTab) {
                activateTab(activeTab); // Activate the tab based on the URL parameter
            } else {
                activateTab('b-w-tab1'); // Default to the first tab
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkSame = document.getElementById('check_same');
            const examTypeOne = document.getElementById('exam_type_one');
            const resultSlipOne = document.getElementById('results_slip_one');
            checkSame.addEventListener('change', function() {
                if (checkSame.checked) {
                    const examTypeValue = examTypeOne.value;
                    const resultSlipValue = resultSlipOne.value;
                    // Copy values to other fields
                    document.getElementById('exam_type_two').value = examTypeValue;
                    document.getElementById('results_slip_two').value = resultSlipValue;

                    document.getElementById('exam_type_three').value = examTypeValue;
                    document.getElementById('results_slip_three').value = resultSlipValue;

                    document.getElementById('exam_type_four').value = examTypeValue;
                    document.getElementById('results_slip_four').value = resultSlipValue;

                    document.getElementById('exam_type_five').value = examTypeValue;
                    document.getElementById('results_slip_five').value = resultSlipValue;

                    document.getElementById('exam_type_six').value = examTypeValue;
                    document.getElementById('results_slip_six').value = resultSlipValue;
                } else {
                    // Optionally clear the copied values when unchecked
                    document.getElementById('exam_type_two').value = '';
                    document.getElementById('results_slip_two').value = '';

                    document.getElementById('exam_type_three').value = '';
                    document.getElementById('results_slip_three').value = '';

                    document.getElementById('exam_type_four').value = '';
                    document.getElementById('results_slip_four').value = '';

                    document.getElementById('exam_type_five').value = '';
                    document.getElementById('results_slip_five').value = '';

                    document.getElementById('exam_type_six').value = '';
                    document.getElementById('results_slip_six').value = '';
                }
            });
        });
    </script>

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
            const oldBranch = '{{ old('branch', $applied_applicant->branch ?? '') }}';
            const oldCourse = '{{ old('course', $applied_applicant->course ?? '') }}';
            // Fetch branches on page load
            $.ajax({
                url: '{{ route('get.branches') }}',
                method: 'GET',
                success: function(data) {
                    let branchSelect = $('#branch');
                    branchSelect.empty();
                    branchSelect.append('<option value="">Select Branch</option>');
                    $.each(data, function(key, branch) {
                        let selected = (oldBranch == branch.id) ? 'selected' : '';
                        branchSelect.append('<option value="' + branch.id + '" ' + selected +
                            '>' + branch.branch + '</option>');
                    });
                    // If a branch was previously selected, trigger the change event to load the courses
                    if (oldBranch) {
                        branchSelect.trigger('change');
                    }
                },
                error: function(xhr) {
                    console.log('Error fetching branches:', xhr);
                }
            });

            // Fetch courses when branch is selected
            $('#branch').on('change', function() {
                let branchId = $(this).val();
                if (branchId) {
                    $.ajax({
                        url: '{{ route('get.courses') }}',
                        method: 'GET',
                        data: {
                            branch_id: branchId
                        },
                        success: function(data) {
                            let courseSelect = $('#course');
                            courseSelect.empty();
                            courseSelect.append('<option value="">Select Course</option>');
                            $.each(data, function(key, course) {
                                let selected = (oldCourse == course.id) ? 'selected' :
                                    '';
                                courseSelect.append('<option value="' + course.id +
                                    '" ' + selected + '>' + course.course_name +
                                    '</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log('Error fetching courses:', xhr);
                        }
                    });
                } else {
                    $('#course').empty();
                    $('#course').append('<option value="">Select Course</option>');
                }
            });
        });
    </script>

    <script>
        document.getElementById('bece_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.type === 'application/pdf') {
                    // Display file name
                    var fileName = document.createElement('p');
                    fileName.textContent = 'Selected file: ' + file.name;
                    filePreview.appendChild(fileName);
                    // Optionally, provide a link to open the PDF
                    var fileLink = document.createElement('a');
                    fileLink.href = URL.createObjectURL(file);
                    fileLink.textContent = 'View PDF';
                    fileLink.target = '_blank';
                    filePreview.appendChild(fileLink);
                } else {
                    filePreview.textContent = 'Please select a PDF file.';
                }
            }
        });
    </script>

    <script>
        document.getElementById('wassce_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('wassce-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.type === 'application/pdf') {
                    // Display file name
                    var fileName = document.createElement('p');
                    fileName.textContent = 'Selected file: ' + file.name;
                    filePreview.appendChild(fileName);
                    // Optionally, provide a link to open the PDF
                    var fileLink = document.createElement('a');
                    fileLink.href = URL.createObjectURL(file);
                    fileLink.textContent = 'View PDF';
                    fileLink.target = '_blank';
                    filePreview.appendChild(fileLink);
                } else {
                    filePreview.textContent = 'Please select a PDF file.';
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#district').change(function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: '/get-regions/' + district_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#region').empty();
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#region').append('<option value="' + value.id +
                                        '">' + value.region_name + '</option>');
                                });
                            } else {
                                $('#region').append(
                                    '<option value="">No regions available</option>');
                            }
                        }
                    });
                } else {
                    $('#region').empty();
                    $('#region').append('<option value="">Select Region</option>');
                }
            });
        });
    </script>

    <script>
        document.getElementById('degree_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('degree-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.type === 'application/pdf') {
                    // Display file name
                    var fileName = document.createElement('p');
                    fileName.textContent = 'Selected file: ' + file.name;
                    filePreview.appendChild(fileName);
                    // Optionally, provide a link to open the PDF
                    var fileLink = document.createElement('a');
                    fileLink.href = URL.createObjectURL(file);
                    fileLink.textContent = 'View PDF';
                    fileLink.target = '_blank';
                    filePreview.appendChild(fileLink);
                } else {
                    filePreview.textContent = 'Please select a PDF file.';
                }
            }
        });
    </script>
    <script>
        document.getElementById('professional_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('professional-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.type === 'application/pdf') {
                    // Display file name
                    var fileName = document.createElement('p');
                    fileName.textContent = 'Selected file: ' + file.name;
                    filePreview.appendChild(fileName);
                    // Optionally, provide a link to open the PDF
                    var fileLink = document.createElement('a');
                    fileLink.href = URL.createObjectURL(file);
                    fileLink.textContent = 'View PDF';
                    fileLink.target = '_blank';
                    filePreview.appendChild(fileLink);
                } else {
                    filePreview.textContent = 'Please select a PDF file.';
                }
            }
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

    <script>
        function printData() {
            var divToPrint = document.getElementById("printTable");
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }
        $('.btn-print-invoice').on('click', function() {
            printData();
        })
    </script>

    <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        })
    </script>
@endsection
