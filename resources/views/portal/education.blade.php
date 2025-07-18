@extends('portal.master')
@section('title')
EDUCATION
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
    .heading-green {
    background-color:#424a46;
    color: white;
    padding: 10px;
    border-radius: 8px; /* You can adjust the radius as needed */
}
/* .heading-green {
    display: inline-block;       /* Shrinks the box to fit the content */
    background-color: green;
    color: white;
    padding: 10px 15px;          /* Horizontal padding for spacing */
    border-radius: 8px;
} */
    .body {

            background-image: url('{{ asset('UJ.jpg') }}');
        }

    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">


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

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 style="text-align: center; font-family: Arial Black, Helvetica, sans-serif;">
                                     WELCOME TO THE GHANA ARMED FORCES RECRUITMENT PORTAL
                                </h4>
                                <marquee behavior="scroll" direction="left" scrollamount="2"
                                    style="font-family: Arial, sans-serif; font-size: 16px; color: #ff0000; font-weight: bold; text-transform: uppercase;">
                                    PLEASE COMPLETE THE VARIOUS FORMS BY CLICKING "NEXT" TO COMPLETE YOUR APPLICATION.
                                </marquee>
                                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            <!-- Display a specific message if duplicate subjects are selected -->
            @if ($errors->has('bece_subject_three') || $errors->has('bece_subject_four') || $errors->has('bece_subject_five') || $errors->has('bece_subject_six') ||
                $errors->has('wassce_subject_three') || $errors->has('wassce_subject_four') || $errors->has('wassce_subject_five') || $errors->has('wassce_subject_six'))
                <li>Do not choose a subject more than once</li>
            @endif

            <!-- Display all other errors -->
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
                                <h5>Applicant: {{ $applied_applicant->surname }}{{ $applied_applicant->first_name}} {{ $applied_applicant->other_names }}</h5>
                            </div>
                            <div class="card-body" style="margin-left: 2cm; margin-right: 2cm;">
                                <div class="bt-wizard" id="progresswizard">
                                    <ul class="nav nav-pills nav-fill mb-3"
                                        style="text-align: center; font-family: Arial Black, Helvetica, sans-serif;">
                                        <li class="nav-item"><a href="#b-w-tab2" class="nav-link"
                                                data-toggle="tab">EDUCATIONAL DETAILS</a></li>
                                    </ul>
                                    <div id="bar" class="bt-wizard progress mb-3" style="height:6px">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="b-w-tab2">
                                            <form id="form2" action="{{ route('saveEducationData') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">

                                                   <div class="col-md-12">


                                                       <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="mt-5 heading-green">Basic Education details</h5>
                                                        <hr>
                                                        <div style="">
                                                            <div class="form-group row">
                                                                <label for="b-t-name" class="col-sm-3 col-form-label">BECE
                                                                    Index Number</label>
                                                                <div class="col-sm-3">
                                                                    <input type="text" class="form-control "
                                                                        id="bece_index_number" name="bece_index_number"
                                                                        value="{{ old('bece_index_number', $applied_applicant->bece_index_number) }}" maxlength="10">
                                                                    @error('bece_index_number')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <label for="b-t-name" class="col-sm-3 col-form-label">JHS
                                                                    Completion Year</label>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group fill">
                                                                        <input type="date" class="form-control date-picker"
                                                                            id="bece_year_completion"
                                                                            name="bece_year_completion"
                                                                            value="{{ old('bece_year_completion', $applied_applicant->bece_year_completion) }}">
                                                                        @error('bece_year_completion')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name" class="col-sm-3 col-form-label">Upload
                                                                    JHS
                                                                    Certificate</label>
                                                                <div class="col-sm-3">
                                                                    <div
                                                                        class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                        <i class="feather icon-paperclip"></i> Add
                                                                        Attachment
                                                                        <input type="file" name="bece_certificate"
                                                                            accept=".pdf" id="bece_certificate" />
                                                                        @error('bece_certificate')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>

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
                                                     <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                                <div class="col-md-12">
    <h5 class="mt-5">Select Best Six (6) BECE Grades</h5>
    <hr>

    {{-- Top Row: Core Subjects --}}
    <div class="row">
        {{-- English Language --}}
        <div class="col-md-4 mb-3">
            <label>English Language <span class="text-danger">*</span></label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_english" class="form-control" readonly>
                        <option value="ENGLISH LANGUAGE" {{ old('bece_english', $applied_applicant->bece_english) == 'ENGLISH LANGUAGE' ? 'selected' : '' }}>ENGLISH LANGUAGE</option>
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_english_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_english_grade', $applied_applicant->bece_subject_english_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_english_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Mathematics --}}
        <div class="col-md-4 mb-3">
            <label>Mathematics <span class="text-danger">*</span></label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_mathematics" class="form-control" readonly>
                        <option value="MATHEMATICS" {{ old('bece_mathematics', $applied_applicant->bece_mathematics) == 'MATHEMATICS' ? 'selected' : '' }}>MATHEMATICS</option>
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_maths_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_maths_grade', $applied_applicant->bece_subject_maths_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_maths_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Integrated Science --}}
        <div class="col-md-4 mb-3">
            <label>Integrated Science <span class="text-danger">*</span></label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_subject_three" class="form-control" readonly>
                        <option value="INTEGRATED SCIENCE" {{ old('bece_subject_three', $applied_applicant->bece_subject_three) == 'INTEGRATED SCIENCE' ? 'selected' : '' }}>INTEGRATED SCIENCE</option>
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_three_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_three_grade', $applied_applicant->bece_subject_three_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_three_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    {{-- Bottom Row: Elective Subjects --}}
    <div class="row">
        {{-- Subject 4 --}}
        <div class="col-md-4 mb-3">
            <label>Subject 4</label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_subject_four" class="form-control">
                        <option value="">Select Subject</option>
                        @foreach ($bece_subject as $subject)
                            <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_four', $applied_applicant->bece_subject_four) == $subject->becesubjects ? 'selected' : '' }}>
                                {{ $subject->becesubjects }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_four_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_four_grade', $applied_applicant->bece_subject_four_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_four') <span class="text-danger">Subject Duplicated: {{ $message }}</span> @enderror
            @error('bece_subject_four_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Subject 5 --}}
        <div class="col-md-4 mb-3">
            <label>Subject 5</label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_subject_five" class="form-control">
                        <option value="">Select Subject</option>
                        @foreach ($bece_subject as $subject)
                            <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_five', $applied_applicant->bece_subject_five) == $subject->becesubjects ? 'selected' : '' }}>
                                {{ $subject->becesubjects }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_five_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_five_grade', $applied_applicant->bece_subject_five_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_five') <span class="text-danger">Subject Duplicated: {{ $message }}</span> @enderror
            @error('bece_subject_five_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Subject 6 --}}
        <div class="col-md-4 mb-3">
            <label>Subject 6</label>
            <div class="form-row">
                <div class="col-8">
                    <select name="bece_subject_six" class="form-control">
                        <option value="">Select Subject</option>
                        @foreach ($bece_subject as $subject)
                            <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_six', $applied_applicant->bece_subject_six) == $subject->becesubjects ? 'selected' : '' }}>
                                {{ $subject->becesubjects }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <select name="bece_subject_six_grade" class="form-control bece-grade">
                        <option value="">Grade</option>
                        @foreach ($bece_results as $grade)
                            <option value="{{ $grade->beceresults }}" {{ old('bece_subject_six_grade', $applied_applicant->bece_subject_six_grade) == $grade->beceresults ? 'selected' : '' }}>
                                {{ $grade->beceresults }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @error('bece_subject_six') <span class="text-danger">Subject Duplicated: {{ $message }}</span> @enderror
            @error('bece_subject_six_grade') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
</div>
                                                    <div class="col-md-12">
                                                        <h5 class="mt-5 heading-green">Secondary Education Details</h5>
                                                        <hr>
                                                        <div style="">
                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-3 col-form-label">WASSCE
                                                                    Index
                                                                    Number(s)</label>
                                                                <div class="col-sm-3">
                                                                    <input type="text" class="form-control required"
                                                                        id="wassce_index_number"
                                                                        name="wassce_index_number"
                                                                        value="{{ old('wassce_index_number', $applied_applicant->wassce_index_number) }}" maxlength="12">
                                                                    @error('wassce_index_number')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <label for="b-t-name" class="col-sm-3 col-form-label">SHS
                                                                    Completion Year</label>
                                                                <div class="col-sm-3">
                                                                    <input class="form-control date-picker required"
                                                                        id="wassce_year_completion"
                                                                        name="wassce_year_completion" type="date"
                                                                        value="{{ old('wassce_year_completion', $applied_applicant->wassce_year_completion) }}" >
                                                                    @error('wassce_year_completion')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="b-t-name"
                                                                    class="col-sm-3 col-form-label">
                                                                    Results Slip
                                                                    Number(s)/Index Number</label>
                                                                <div class="col-sm-3">
                                                                    <input type="text" class="form-control required"
                                                                        id="wassce_serial_number"
                                                                        name="wassce_serial_number"
                                                                        value="{{ old('wassce_serial_number', $applied_applicant->wassce_serial_number) }}">
                                                                    @error('wassce_serial_number')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <label for="b-t-name"
                                                                    class="col-sm-3 col-form-label">Course
                                                                    Offerred</label>

                                                                <div class="col-sm-3">
                                                                  <select class="form-control required" id="secondary_course_offered" name="secondary_course_offered">
    <option value="">Choose Course</option>
    @foreach(['GENERAL ARTS', 'SCIENCE', 'HOME ECONOMICS','AGRICULTURAL SCIENCE', 'VISUAL ARTS','BUSINESS'] as $course)
        <option value="{{ $course }}" {{ old('secondary_course_offered', $applied_applicant->secondary_course_offered) == $course ? 'selected' : '' }}>
            {{ $course }}
        </option>
    @endforeach
</select>
                                                                    @error('secondary_course_offered')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">

                                                                <label for="b-t-name" class="col-sm-3 col-form-label">Name
                                                                    of SHS</label>
                                                                <div class="col-sm-3">
                                                                    <input type="text" class="form-control required"
                                                                        id="name_of_secondary_school"
                                                                        name="name_of_secondary_school"
                                                                        value="{{ old('name_of_secondary_school', $applied_applicant->name_of_secondary_school) }}">
                                                                    @error('name_of_secondary_school')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

<label for="b-t-name" class="col-sm-3 col-form-label">Upload SHS Certificates</label>
<div class="col-sm-3">
    <div id="files-container">
        <!-- DEFAULT FILE INPUT (no remove) -->
        <div class="file-group">
            <div class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                <i class="feather icon-paperclip"></i> Add Attachment
                <input type="file" name="wassce_certificate[]" accept=".pdf" class="wassce_certificate" />
            </div>
            <div class="file-preview mt-2"></div>
        </div>
    </div>

    <!-- BUTTON TO ADD MORE -->
    <button type="button" id="add-file" class="btn btn-sm btn-success mt-2">Add Another File</button>

    {{-- EXISTING FILES IF ANY --}}
    <div id="existing-files" class="mt-2">
    @if(!empty($applied_applicant->wassce_certificate))
        @foreach(json_decode($applied_applicant->wassce_certificate) as $index => $file)
            <div>
                {{ $index + 1 }}.
                <a href="{{ asset($file) }}" target="_blank">{{ basename($file) }}</a>
            </div>
        @endforeach
    @endif
</div>


    @error('wassce_certificate.*')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <h5 class="mt-5 ">Select Best Six (6) WASSCE Grades</h5>
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_one', $applied_applicant->exam_type_one) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_one')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_english" name="wassce_english"
                                                                    class="form-control"readonly>
                                                                    <option value="ENGLISH LANGUAGE"
                                                                        {{ old('wassce_english', $applied_applicant->wassce_english) == 'ENGLISH LANGUAGE' ? 'selected' : '' }}>
                                                                        ENGLISH LANGUAGE</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_english_grade"
                                                                    name="wassce_subject_english_grade"
                                                                    class="form-control required" grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_english_grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_one"
                                                                    name="results_slip_one" class="form-control"
                                                                    value="{{ old('results_slip_one', $applied_applicant->results_slip_one) }}"
                                                                    placeholder="Results Slip Number(s) /Index Number" required>
                                                                <input type="checkbox" id="check_same" name="check_same"
                                                                    class="ml-2"> Same as above
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_two', $applied_applicant->exam_type_two) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_two')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_mathematics" name="wassce_mathematics"
                                                                    class="form-control"readonly>
                                                                    <option value="CORE MATHEMATICS"
                                                                        {{ old('wassce_mathematics', $applied_applicant->wassce_mathematics) == 'CORE MATHEMATICS' ? 'selected' : '' }}>
                                                                        CORE MATHEMATICS
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_maths_grade"
                                                                    name="wassce_subject_maths_grade"
                                                                    class="form-control required" grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_maths_grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_two"
                                                                    id="results_slip_two" name="results_slip_two"
                                                                    class="form-control"
                                                                    value="{{ old('results_slip_two', $applied_applicant->results_slip_two) }}"
                                                                    placeholder="Results Slip Number(s)/Index Number">
                                                                @error('results_slip_two')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_three', $applied_applicant->exam_type_three) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_three')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_three" name="wassce_subject_three" class="form-control"readonly>
                                                                    <option value="INTEGRATED SCIENCE"{{ old('wassce_subject_three', $applied_applicant->wassce_subject_three) == 'INTEGRATED SCIENCE' ? 'selected' : '' }}>
                                                                    INTEGRATED SCIENCE</option>
                                                                </select>
                                                                @error('wassce_subject_three')
                                                                    <span class="text-danger">Subject Duplicated</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_three_grade"
                                                                    name="wassce_subject_three_grade"
                                                                    class="form-control required" grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_three_grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_three"
                                                                    name="results_slip_three" class="form-control"
                                                                    value="{{ old('results_slip_three', $applied_applicant->results_slip_three) }}"
                                                                    placeholder="Results Slip Number(s)/Index Number" required>
                                                               @error('result_slip_three')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_four', $applied_applicant->exam_type_four) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_four')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_four"
                                                                    name="wassce_subject_four"
                                                                    class="form-control required">
                                                                    <option value="">Select Subject</option>
                                                                    @foreach ($wassce_subject as $subject)
                                                                        <option value="{{ $subject->wasscesubjects }}"
                                                                            {{ old('wassce_subject_four', $applied_applicant->wassce_subject_four) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                            {{ $subject->wasscesubjects }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('wassce_subject_four')
                                                                    <span class="text-danger">Subject Duplicated</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_four_grade"
                                                                    name="wassce_subject_four_grade"
                                                                    class="form-control required"grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_four_grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_four"
                                                                    name="results_slip_four" class="form-control"
                                                                    value="{{ old('results_slip_four', $applied_applicant->results_slip_four) }}"
                                                                    placeholder="Results Slip Number(s)/Index Number" required>
                                                                @error('result_slip_four')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_five', $applied_applicant->exam_type_five) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_five')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_five"
                                                                    name="wassce_subject_five"
                                                                    class="form-control required">
                                                                    <option value="">Select Subject</option>
                                                                    @foreach ($wassce_subject as $subject)
                                                                        <option value="{{ $subject->wasscesubjects }}"
                                                                            {{ old('wassce_subject_five', $applied_applicant->wassce_subject_five) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                            {{ $subject->wasscesubjects }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('wassce_subject_five')
                                                                    <span class="text-danger">Subject Duplicated</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_five_grade"
                                                                    name="wassce_subject_five_grade"
                                                                    class="form-control required" grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_five_grade')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_five"
                                                                    name="results_slip_five" class="form-control"
                                                                    value="{{ old('results_slip_five', $applied_applicant->results_slip_five) }}"
                                                                    placeholder="Results Slip Number(s)/Index Number">
                                                                @error('results_slip_five')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
                                                                    <option value="SSSCE"
                                                                        {{ old('exam_type_six', $applied_applicant->exam_type_six) == 'SSSCE' ? 'selected' : '' }}>
                                                                        SSSCE</option>
                                                                </select>
                                                                @error('exam_type_six')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_six" name="wassce_subject_six"
                                                                    class="form-control required">
                                                                    <option value="">Select Subject</option>
                                                                    @foreach ($wassce_subject as $subject)
                                                                        <option value="{{ $subject->wasscesubjects }}"
                                                                            {{ old('wassce_subject_six', $applied_applicant->wassce_subject_six) == $subject->wasscesubjects ? 'selected' : '' }}>
                                                                            {{ $subject->wasscesubjects }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('wassce_subject_six')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select id="wassce_subject_six_grade"
                                                                    name="wassce_subject_six_grade"
                                                                    class="form-control required" grade-select>
                                                                    <option value="">Grade</option>

                                                                </select>
                                                                @error('wassce_subject_six_grade')
                                                                    <span class="text-danger">Subject Duplicated</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" id="results_slip_six"
                                                                    name="results_slip_six" class="form-control"
                                                                    value="{{ old('results_slip_six', $applied_applicant->results_slip_six) }}"
                                                                    placeholder="Results Slip Number(s)/Index Number">
                                                                @error('results_slip_six')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>

                                                   @if($applied_applicant->entrance_type === 'TOP UP')
    <div class="col-md-12">
        <h5 class="mt-5 heading-green">Top Up Infomation</h5>
        <hr>
        <div>
            <div class="form-group row">
                <label for="b-t-name" class="col-sm-3 col-form-label">Institution</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control"
                        id="institution" name="institution"
                        value="{{ old('institution', $applied_applicant->institution) }}" >
                    @error('institution')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <label for="b-t-name" class="col-sm-3 col-form-label">Upload NMC/Results slip</label>
                <div class="col-sm-3">
                    <div class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                        <i class="feather icon-paperclip"></i> Add Attachment
                        <input type="file" name="results_certificate"
                            accept=".pdf" id="results_certificate" />
                        @error('results_certificate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="results_certificate-file-preview" class="mt-2">
                        @if ($applied_applicant->results_certificate)
                            <p>Selected file:
                                {{ pathinfo($applied_applicant->results_certificate, PATHINFO_FILENAME) }}.{{ pathinfo($applied_applicant->results_certificate, PATHINFO_EXTENSION) }}
                            </p>
                            <a href="{{ asset($applied_applicant->results_certificate) }}" target="_blank">View PDF</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="b-t-name" class="col-sm-3 col-form-label">Upload Transcript</label>
                <div class="col-sm-3">
                    <div class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                        <i class="feather icon-paperclip"></i> Add Attachment
                        <input type="file" name="transcript"
                            accept=".pdf" id="transcript" />
                        @error('transcript')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="transcript-file-preview" class="mt-2">
                        @if ($applied_applicant->transcript)
                            <p>Selected file:
                                {{ pathinfo($applied_applicant->transcript, PATHINFO_FILENAME) }}.{{ pathinfo($applied_applicant->transcript, PATHINFO_EXTENSION) }}
                            </p>
                            <a href="{{ asset($applied_applicant->transcript) }}" target="_blank">View PDF</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-secondary save-btn"
                                                            id="saveEducationData" style="float: right;">NEXT STEP</button>
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

        </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Required Js -->
    <script src="{{ asset('frontend/assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/ripple.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.bootstrap.wizard.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/moment.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.full.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/pages/form-select-custom.js') }}"></script>
    <script>
    let selectedFour = "{{ old('wassce_subject_four', $applied_applicant->wassce_subject_four) }}";
    let selectedFive = "{{ old('wassce_subject_five', $applied_applicant->wassce_subject_five) }}";
    let selectedSix = "{{ old('wassce_subject_six', $applied_applicant->wassce_subject_six) }}";

    function populateSubjects(subjects) {
        const selects = [
            { id: '#wassce_subject_four', selected: selectedFour },
            { id: '#wassce_subject_five', selected: selectedFive },
            { id: '#wassce_subject_six', selected: selectedSix },
        ];

        selects.forEach(({ id, selected }) => {
            $(id).empty().append('<option value="">Select Subject</option>');
            $.each(subjects, function (index, subject) {
                let isSelected = (subject.wasscesubjects === selected) ? 'selected' : '';
                $(id).append('<option value="' + subject.wasscesubjects + '" ' + isSelected + '>' + subject.wasscesubjects + '</option>');
            });
        });
    }

    $('#secondary_course_offered').on('change', function () {
        let selectedCourse = $(this).val();
        $.get('{{ route("get-wassce-subjects") }}', { course: selectedCourse }, populateSubjects);
    });

    // Optional: trigger on load if course is already selected
    @if(old('secondary_course_offered', $applied_applicant->secondary_course_offered))
        $(document).ready(function () {
            $('#secondary_course_offered').trigger('change');
        });
    @endif
</script>

<script>
    const wassceGrades = @json(array_values($wassce_grades));
    const sssceGrades = @json(array_values($sssce_grades));

    const subjects = [
        { examTypeId: 'exam_type_one', gradeId: 'wassce_subject_english_grade', oldGrade: "{{ old('wassce_subject_english_grade', $applied_applicant->wassce_subject_english_grade ?? '') }}" },
        { examTypeId: 'exam_type_two', gradeId: 'wassce_subject_maths_grade', oldGrade: "{{ old('wassce_subject_maths_grade', $applied_applicant->wassce_subject_maths_grade ?? '') }}" },
        { examTypeId: 'exam_type_three', gradeId: 'wassce_subject_three_grade', oldGrade: "{{ old('wassce_subject_three_grade', $applied_applicant->wassce_subject_three_grade ?? '') }}" },
        { examTypeId: 'exam_type_four', gradeId: 'wassce_subject_four_grade', oldGrade: "{{ old('wassce_subject_four_grade', $applied_applicant->wassce_subject_four_grade ?? '') }}" },
        { examTypeId: 'exam_type_five', gradeId: 'wassce_subject_five_grade', oldGrade: "{{ old('wassce_subject_five_grade', $applied_applicant->wassce_subject_five_grade ?? '') }}" },
        { examTypeId: 'exam_type_six', gradeId: 'wassce_subject_six_grade', oldGrade: "{{ old('wassce_subject_six_grade', $applied_applicant->wassce_subject_six_grade ?? '') }}" }
    ];

    function updateGradeOptions(gradeSelectId, examType, selectedGrade = "") {
    const gradeSelect = document.getElementById(gradeSelectId);
    if (!gradeSelect) return;

    gradeSelect.innerHTML = '<option value="">Grade</option>';

    // Treat WASSCE and PRIVATE as same grades
    let grades;
    if (examType === 'SSSCE') {
        grades = sssceGrades;
    } else if (examType === 'WASSCE' || examType === 'PRIVATE') {
        grades = wassceGrades;
    } else {
        grades = [];
    }

    grades.forEach(grade => {
        let option = document.createElement('option');
        option.value = grade;
        option.text = grade;
        if (grade === selectedGrade) {
            option.selected = true;
        }
        gradeSelect.appendChild(option);
    });
}


    document.addEventListener('DOMContentLoaded', function () {
        subjects.forEach(({ examTypeId, gradeId, oldGrade }) => {
            const examSelect = document.getElementById(examTypeId);
            if (!examSelect) return;

            updateGradeOptions(gradeId, examSelect.value, oldGrade);

            examSelect.addEventListener('change', function () {
                updateGradeOptions(gradeId, this.value);
            });
        });
    });
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkSame = document.getElementById('check_same');
            const wassceSerialNumber = document.getElementById('wassce_serial_number');
            const examTypeOne = document.getElementById('exam_type_one');

            function updateFields() {
                if (checkSame.checked) {
                    const serialNumberValue = wassceSerialNumber.value;
                    const examTypeValue = examTypeOne.value;

                    // Populate WASSCE Serial Number fields
                    document.getElementById('results_slip_one').value = serialNumberValue;
                    document.getElementById('results_slip_two').value = serialNumberValue;
                    document.getElementById('results_slip_three').value = serialNumberValue;
                    document.getElementById('results_slip_four').value = serialNumberValue;
                    document.getElementById('results_slip_five').value = serialNumberValue;
                    document.getElementById('results_slip_six').value = serialNumberValue;

                    // Populate Exam Type fields
                    document.getElementById('exam_type_two').value = examTypeValue;
                    document.getElementById('exam_type_three').value = examTypeValue;
                    document.getElementById('exam_type_four').value = examTypeValue;
                    document.getElementById('exam_type_five').value = examTypeValue;
                    document.getElementById('exam_type_six').value = examTypeValue;
                }
            }

            // When checkbox is clicked
            checkSame.addEventListener('change', function() {
                if (!checkSame.checked) {
                    // Clear values when unchecked
                    document.getElementById('results_slip_two').value = '';
                    document.getElementById('results_slip_three').value = '';
                    document.getElementById('results_slip_four').value = '';
                    document.getElementById('results_slip_five').value = '';
                    document.getElementById('results_slip_six').value = '';

                    document.getElementById('exam_type_two').value = '';
                    document.getElementById('exam_type_three').value = '';
                    document.getElementById('exam_type_four').value = '';
                    document.getElementById('exam_type_five').value = '';
                    document.getElementById('exam_type_six').value = '';
                } else {
                    updateFields();
                }
            });

            // Listen for changes in `exam_type_one` or `wassce_serial_number` and update fields dynamically
            examTypeOne.addEventListener('input', function() {
                if (checkSame.checked) {
                    updateFields();
                }
            });

            wassceSerialNumber.addEventListener('input', function() {
                if (checkSame.checked) {
                    updateFields();
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
    const MAX_FILE_SIZE = 1024 * 1024;

    const filesContainer = document.getElementById('files-container');
    const addFileButton = document.getElementById('add-file');

    // Handle Preview Logic
    filesContainer.addEventListener('change', function(event) {
        if (event.target.classList.contains('wassce_certificate')) {
            const fileInput = event.target;
            const previewContainer = fileInput.closest('.file-group').querySelector('.file-preview');
            previewContainer.innerHTML = '';
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                if (file.size > MAX_FILE_SIZE) {
                    previewContainer.textContent = 'File size exceeds 1MB. Please select a smaller file.';
                    fileInput.value = '';
                    return;
                }
                if (file.type === 'application/pdf') {
                    const fileName = document.createElement('p');
                    fileName.textContent = 'Selected file: ' + file.name;
                    previewContainer.appendChild(fileName);

                    const fileLink = document.createElement('a');
                    fileLink.href = URL.createObjectURL(file);
                    fileLink.textContent = 'View PDF';
                    fileLink.target = '_blank';
                    previewContainer.appendChild(fileLink);
                } else {
                    previewContainer.textContent = 'Please select a PDF file.';
                }
            }
        }
    });

    // Add New File Group
    addFileButton.addEventListener('click', function() {
        const newFileGroup = document.createElement('div');
        newFileGroup.classList.add('file-group');
        newFileGroup.innerHTML = `
            <div class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                <i class="feather icon-paperclip"></i> Add Attachment
                <input type="file" name="wassce_certificate[]" accept=".pdf" class="wassce_certificate" />
            </div>
            <div class="file-preview mt-2"></div>
            <button type="button" class="btn btn-sm btn-danger mt-2 remove-file">Remove</button>
        `;
        filesContainer.appendChild(newFileGroup);
    });

    // Remove Additional File Group
    filesContainer.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-file')) {
            event.target.closest('.file-group').remove();
        }
    });
</script>

{{--
    <script>
        document.getElementById('wassce_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('wassce-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.size > 1048576) {
                    filePreview.textContent = 'File size exceeds 1MB. Please select a smaller file.';
                    fileInput.value = ''; // Clear the file input
                    return; // Exit the function if the file is too large
                }

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
    </script> --}}

 <script>
        document.getElementById('results_certificate').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('results_certificate-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.size > 1048576) {
                    filePreview.textContent = 'File size exceeds 1MB. Please select a smaller file.';
                    fileInput.value = ''; // Clear the file input
                    return; // Exit the function if the file is too large
                }

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
        document.getElementById('transcript').addEventListener('change', function(event) {
            var fileInput = event.target;
            var filePreview = document.getElementById('transcript-file-preview');
            // Clear previous preview
            filePreview.innerHTML = '';
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];
                if (file.size > 1048576) {
                    filePreview.textContent = 'File size exceeds 1MB. Please select a smaller file.';
                    fileInput.value = ''; // Clear the file input
                    return; // Exit the function if the file is too large
                }

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
        document.addEventListener("DOMContentLoaded", function () {
            // Get the current year
            let currentYear = new Date().getFullYear();

            // Set max date to the last day of the current year (YYYY-12-31)
            let maxDate = currentYear + "-12-31";

            // Apply max date and prevent manual typing
            document.querySelectorAll(".date-picker").forEach(function (input) {
                input.setAttribute("max", maxDate); // Restrict future dates
                input.addEventListener("keydown", function (event) {
                    event.preventDefault(); // Prevent manual input
                });
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
                if (file.size > 1048576) {
                    filePreview.textContent = 'File size exceeds 1MB. Please select a smaller file.';
                    fileInput.value = ''; // Clear the file input
                    return; // Exit the function if the file is too large
                }

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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



@endsection
