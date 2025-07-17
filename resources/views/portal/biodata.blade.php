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
            /* width: 255px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           height: 220px; */
            width: 100%;
        }

    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    {{-- 18570a --}}


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
                                           <b> {{ $applied_applicant->arm_of_service }} / TYPE: {{ $applied_applicant->trade_type }}</b>  </a></li>
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
                                                        $imagePath = public_path($applied_applicant->applicant_image);
                                                    @endphp
                                                    <div class="col-md-2 border-right">
                                                        <div
                                                            class="d-flex flex-column align-items-center text-center p-1 py-5">
                                                             <span class="font-weight-bold">Passport Picture</span>
                                                             <br>
                                                            @if ($applied_applicant->applicant_image == null)
                                                                <img id="showImage"
                                                                    src="{{ url('uploads/profile.png') }}"alt=""
                                                                    height="170px"
                                                                    width="170px">
                                                            @elseif(file_exists($imagePath))
                                                                <img id="showImage"
                                                                    src="{{ asset($applied_applicant->applicant_image) }}"
                                                                    alt="" class="rounded-circle mt-2"
                                                                    height="150px" width="150px">
                                                            @endif
<br>
                                                            <div class="form-group row">
                                                                <div class="input_container">
                                                                    <input name="applicant_image" class="form-control"
                                                                        type="file" id="image" accept=".jpg, .png">
                                                                    @error('applicant_image')
                                                                        <div class="alert alert-danger mt-2">
                                                                            {{ $message }} Please upload a valid file
                                                                            (jpg,png).
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10">

 <div class="form-group row">
<div class="col-md-4 col-12 mb-3">
        <label for="Branch" class="col-form-label" style="display: block; text-align: left;"><b>Branch</b></label>
       <select class="form-control" name="branch_id" id="branch">
    <option value="">Select Branch</option>
    @foreach ($branches as $list)
        <option value="{{ $list->id }}"
            {{ old('branch_id', $applied_applicant->branch_id) == $list->id ? 'selected' : '' }}>
            {{ $list->branch }}
        </option>
    @endforeach
</select>

        @error('branch_id')
<span class="text-danger">{{ $message }}</span>
     @enderror
    </div>

<!-- MULTI-SELECT Sub Branch -->
<div class="col-md-8 col-12 mb-3" id="subBranchWrapper">
    <label for="sub_branch" class="col-form-label" style="display: block; text-align: left;"><b>Sub Branch</b></label>
    <select class="form-control" name="sub_branch_ids[]" id="sub_branch" multiple>
        <!-- options loaded via JS -->
    </select>
    @error('sub_branch_ids')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<!-- MULTI-SELECT Sub Sub Branch -->
<div class="col-md-12 col-12 mb-3 d-none" id="subSubBranchWrapper">
    <label for="sub_sub_branch" class="col-form-label" style="display: block; text-align: left;"><b>Sub Sub Branch</b></label>
    <select class="form-control" name="sub_sub_branch_ids[]" id="sub_sub_branch" multiple>
        <option value="">Select Sub Sub Branch</option>
    </select>
</div>



                                                        </div>

                                                        <div class="form-group row">
                                                            <div class="col-md-4 col-12 mb-3">
                                                                <div class="d-flex flex-column align-items-start">
                                                                    <label for="surname" class="col-form-label pb-1" style="align-self: flex-start;"><b>Surname</b></label>
                                                                    <input type="text" class="form-control" id="surname"
                                                                        name="surname" placeholder=""
                                                                        value="{{ old('surname', $applied_applicant->surname) }}">
                                                                    @error('surname')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12 mb-3">
                                                                <div class="d-flex flex-column align-items-start">
                                                                    <label for="first_names" class="col-form-label pb-1" style="align-self: flex-start;"><b>First Name</b></label>
                                                                    <input type="text" class="form-control"
                                                                        id="first_names" name="first_name" placeholder=""
                                                                        value="{{ old('first_name', $applied_applicant->first_name) }}">
                                                                    @error('first_name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-12 mb-3">
                                                                <div class="d-flex flex-column align-items-start">
                                                                    <label for="other_names" class="col-form-label pb-1" style="align-self: flex-start;"><b>Other Name(s)</b></label>
                                                                    <input type="text" class="form-control"
                                                                        id="other_names" name="other_names" placeholder=""
                                                                        value="{{ old('other_names', $applied_applicant->other_names) }}">
                                                                    @error('other_names')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <br>
                                                        <div class="form-group row">
                                                            <div class="col-md-2 col-12 mb-3">
                                                                <div class="d-flex flex-column align-items-start">
                                                                    <label for="sex" class="col-form-label pb-1" style="align-self: flex-start;"><b>Gender</b></label>
                                                                    <select class="form-control required" id="sex" name="sex">
                                                                        <option value="">Select</option>
                                                                        <option value="MALE" {{ old('sex', $applied_applicant->sex) == 'MALE' ? 'selected' : '' }}>MALE</option>
                                                                        <option value="FEMALE" {{ old('sex', $applied_applicant->sex) == 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                                                                    </select>
                                                                    @error('sex')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 col-12 mb-3">
                                                                <label for="marital_status" class="col-form-label" style="display: block; text-align: left;"><b>Marital Status</b></label>
                                                                <select class="form-control required" id="marital_status" name="marital_status">
                                                                    <option value="">Choose option</option>
                                                                    <option value="SINGLE" {{ old('marital_status', $applied_applicant->marital_status) == 'SINGLE' ? 'selected' : '' }}>SINGLE</option>
                                                                    <option value="MARRIED" {{ old('marital_status', $applied_applicant->marital_status) == 'MARRIED' ? 'selected' : '' }}>MARRIED</option>
                                                                    <option value="DIVORCED" {{ old('marital_status', $applied_applicant->marital_status) == 'DIVORCED' ? 'selected' : '' }}>DIVORCED</option>
                                                                </select>
                                                                @error('marital_status')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-2 col-12 mb-3">
                                                                <label for="date_of_birth" class="col-form-label" style="display: block; text-align: left;"><b>Date of Birth</b></label>
                                                                <input type="date" class="form-control date-picker"
                                                                    id="date_of_birth" name="date_of_birth"
                                                                    value="{{ old('date_of_birth', $applied_applicant->date_of_birth) }}">
                                                                @error('date_of_birth')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-2 col-12 mb-3">
                                                                <label for="birth_certificate" class="col-form-label" style="display: block; text-align: left;"><b>Birth Certificate</b></label>
                                                                <div class="file btn waves-effect waves-light btn-outline-primary mt-3 file-btn">
                                                                    <i class="feather icon-paperclip"></i> <b>Upload</b>
                                                                    <input type="file" name="birth_certificate" accept=".pdf" id="birth_certificate" />
                                                                    @error('birth_certificate')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div id="file-preview" class="mt-2">
                                                                    @if ($applied_applicant->birth_certificate)
                                                                        <p>Selected file:
                                                                            {{ pathinfo($applied_applicant->birth_certificate, PATHINFO_FILENAME) }}.{{ pathinfo($applied_applicant->birth_certificate, PATHINFO_EXTENSION) }}
                                                                        </p>
                                                                        <a href="{{ asset($applied_applicant->birth_certificate) }}" target="_blank">View PDF</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-12 mb-3">
                                                                <label for="contact" class="col-form-label" style="display: block; text-align: left;"><b>Phone</b></label>
                                                                <input type="text" class="form-control required"
                                                                    id="contact" name="contact"
                                                                    value="{{ old('contact', $applied_applicant->contact) }}"
                                                                    readonly>
                                                                @error('contact')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-2 col-12 mb-3">
                                                                <label for="digital_address" class="col-form-label" style="display: block; text-align: left;"><b>Digital Address</b></label>
                                                                <input type="text" class="form-control"
                                                                    id="digital_address" name="digital_address"
                                                                    value="{{ old('digital_address', $applied_applicant->digital_address) }}">
                                                                @error('digital_address')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group row">
                                                              <div class="col-md-4 col-12 mb-3">
                                                                <label for="residential_address" class="col-form-label" style="display: block; text-align: left;"><b>Residential Address</b></label>
                                                                <input type="text" class="form-control"
                                                                    id="residential_address" name="residential_address"
                                                                    value="{{ old('residential_address', $applied_applicant->residential_address) }}">
                                                                @error('residential_address')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
    <!-- Identity Type Dropdown -->
    <div class="col-md-2 col-12 mb-3">
        <label for="identity_type" class="col-form-label" style="display: block; text-align: left;"><b>Identity Type</b></label>
        <select class="form-control" id="identity_type" name="identity_type">
            <option value="">-- Select Type --</option>
            <option value="ECOWAS ID CARD" {{ old('identity_type', $applied_applicant->identity_type) == 'ECOWAS ID CARD' ? 'selected' : '' }}>National ID (Ghana Card)</option>
            <option value="NHIS" {{ old('identity_type', $applied_applicant->identity_type) == 'NHIS' ? 'selected' : '' }}>NHIS</option>
        </select>
        @error('identity_type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- National ID Input -->
    <div class="col-md-2 col-12 mb-3 identity-input" id="ghana_card_input" style="display: none;">
        <label for="national_identity_card" class="col-form-label" style="display: block; text-align: left;"><b>National ID (Ghana Card)</b></label>
        <input type="text" class="form-control"
            id="national_identity_card"
            name="national_identity_card"
            placeholder="GHA-123456789-1"
            maxlength="16"
            pattern="GHA-\d{9}-\d{1}"
            title="Format: GHA-XXXXXXXXX-X (e.g., GHA-123456789-1)"
            value="{{ old('national_identity_card', $applied_applicant->national_identity_card) }}">
        @error('national_identity_card')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>



    <div class="col-md-2 col-12 mb-3 identity-input" id="nhis_input" style="display: none;">
        <label for="nhis_number" class="col-form-label" style="display: block; text-align: left;"><b>NHIS Number</b></label>
           <!-- NHIS Input -->
    <input type="text" class="form-control"
    id="nhis_number"
    name="national_identity_card"
    placeholder="Enter NHIS Number"
    value="{{ old('national_identity_card', $applied_applicant->national_identity_card) }}"
    maxlength="8"
    pattern="\d{8}"
    inputmode="numeric"
    title="Enter exactly 8 digits"
    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,8)">
        @error('national_identity_card')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Language(s) Spoken -->
    <div class="col-md-4 col-12 mb-3">
        <label for="languages" class="col-form-label" style="display: block; text-align: left;"><b>Language(s) Spoken</b></label>
        <select class="form-control" multiple="multiple" id="languages" name="language[]">
            @foreach ($ghanaian_languages as $language)
                <option value="{{ $language }}"
                    {{ in_array($language, old('language', $applied_applicant->language ?? [])) ? 'selected' : '' }}>
                    {{ $language }}
                </option>
            @endforeach
        </select>
        @error('language')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>


</div>

 <div class="form-group row">
<div class="col-md-4 col-12 mb-3">
        <label for="languages" class="col-form-label" style="display: block; text-align: left;"><b>Region</b></label>
       <select class="form-control" name="region_id" id="region">
    <option value="">Select Region</option>
    @foreach ($regions as $region)
        <option value="{{ $region->id }}"
            {{ old('region_id', $applied_applicant->region_id) == $region->id ? 'selected' : '' }}>
            {{ $region->region_name }}
        </option>
    @endforeach
</select>

        @error('region_id')
<span class="text-danger">{{ $message }}</span>
 @enderror
    </div>
<div class="col-md-4 col-12 mb-3">
        <label for="languages" class="col-form-label" style="display: block; text-align: left;"><b>District</b></label>
       <select class="form-control" name="district_id" id="district">
    <option value="">Select District</option>
    @foreach ($districts as $district)
        <option value="{{ $district->id }}"
            {{ old('district_id', $applied_applicant->district_id) == $district->id ? 'selected' : '' }}>
            {{ $district->district_name }}
        </option>
    @endforeach
</select>

        @error('district_id')
<span class="text-danger">{{ $message }}</span>
                                                                @enderror
    </div>
 <div class="col-md-4 col-12 mb-3">
                                                                <label for="home_town" class="col-form-label" style="display: block; text-align: left;"><b>Home Town</b></label>
                                                                <input type="text" class="form-control required"
                                                                    id="home_town" name="home_town"
                                                                    value="{{ old('home_town', $applied_applicant->home_town) }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
   <div class="form-group row">

<div class="col-md-4 col-12 mb-3">
        <label for="languages" class="col-form-label" style="display: block; text-align: left;"><b>Height</b></label>
        <select class="form-control"  name="height">
            <option value="">Select</option>
                                                                    @for ($i = 5; $i <= 7; $i++)
                                                                        @for ($j = 0; $j <= 11; $j++)
                                                                            @php
                                                                                $value = number_format($i + $j / 12, 1);
                                                                            @endphp
                                                                            <option value="{{ $value }}"
                                                                                {{ old('height', number_format((float) $applied_applicant->height, 1)) == $value ? 'selected' : '' }}>
                                                                                {{ $value }}
                                                                            </option>
                                                                        @endfor
                                                                    @endfor
                                                                </select>
        @error('height')
<span class="text-danger">{{ $message }}</span>
                                                                @enderror
    </div>

     <div class="col-md-4 col-12 mb-3">
                                                                <label for="email" class="col-form-label" style="display: block; text-align: left;"><b>Weight</b></label>
                                                                <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $applied_applicant->weight) }}" min="1" step="1" required>
    @error('weight')
        <span class="text-danger">{{ $message }}</span>
    @enderror

                                                            </div>
       <div class="col-md-4 col-12 mb-3">
                                                                <label for="email" class="col-form-label" style="display: block; text-align: left;"><b>Email Address</b></label>
                                                                <input type="text" class="form-control required"
                                                                    id="email" name="email"
                                                                    value="{{ old('email', $applied_applicant->email) }}">
                                                                @error('email')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                        <div class="form-group row">

<div class="col-md-12 col-12 mb-3">
        <label for="languages" class="col-form-label" style="display: block; text-align: left;"><b>Sports Interest</b></label>
        <select class="form-control" multiple="multiple" id="sports_interest" name="sports_interest[]">
            @foreach ($sports_interests as $interest)
                                                                        <option value="{{ $interest }}"
                                                                            {{ in_array($interest, old('sports_interest', $applied_applicant->sports_interest ?? [])) ? 'selected' : '' }}>
                                                                            {{ $interest }}
                                                                        </option>
                                                                    @endforeach</select>
        @error('sports_interest')
<span class="text-danger">{{ $message }}</span>
                                                                @enderror
    </div>

                                                        </div>

                                                        <hr>
                                                        <button type="submit" class="btn btn-secondary save-btn"
                                                            style="float: right;" id="saveBioData">NEXT STEP</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

   <script>
document.addEventListener('DOMContentLoaded', function () {
    const identityType = document.getElementById('identity_type');
    const ghanaCardInputDiv = document.getElementById('ghana_card_input');
    const nhisInputDiv = document.getElementById('nhis_input');
    const ghanaCardInput = document.getElementById('national_identity_card');
    const nhisInput = document.getElementById('nhis_number');

    function toggleIdentityInputs() {
        const selected = identityType.value;
        if (selected === 'ECOWAS ID CARD') {
            ghanaCardInputDiv.style.display = 'block';
            ghanaCardInput.disabled = false;
            nhisInputDiv.style.display = 'none';
            nhisInput.disabled = true;
        } else if (selected === 'NHIS') {
            ghanaCardInputDiv.style.display = 'none';
            ghanaCardInput.disabled = true;
            nhisInputDiv.style.display = 'block';
            nhisInput.disabled = false;
        } else {
            ghanaCardInputDiv.style.display = 'none';
            ghanaCardInput.disabled = true;
            nhisInputDiv.style.display = 'none';
            nhisInput.disabled = true;
        }
    }
    identityType.addEventListener('change', toggleIdentityInputs);
    // Initial call on page load to show correct input if old value is present
    toggleIdentityInputs();
});
</script>


    <style>
        /* Change text color of selected options */
        .select2-selection__choice {
            color: red !important;
            font-weight: bold;
        }
    </style>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#languages').select2({
                placeholder: "Select languages",
                allowClear: true
            });
        });
    </script>
  <script>
        $(document).ready(function() {
            $('#sports_interest').select2({
                placeholder: "Select languages",
                allowClear: true
            });
        });
    </script>


 <!-- Initialize Select2 -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage')
                    .attr('src', e.target.result)
                    .addClass('rounded-circle'); // Apply rounded after picking
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script> --}}

  <script>
    $(document).ready(function() {
        $('#region').change(function() {
            var regionId = $(this).val();
            if (regionId) {
                $.ajax({
                    url: '/applicant/get-districts/' + regionId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district').empty().append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.district_name + '</option>');
                        });
                    }
                });
            } else {
                $('#district').empty().append('<option value="">Select District</option>');
            }
        });
    });
</script>



    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the current date in YYYY-MM-DD format
            let today = new Date().toISOString().split("T")[0];
            // Apply max date to all date inputs
            document.querySelectorAll(".date-picker").forEach(function (input) {
                input.setAttribute("max", today); // Set max attribute to prevent future dates

                input.addEventListener('keydown', function (event) {
                    event.preventDefault(); // Prevent manual typing
                });
            });
        });
    </script>

 <script>
        document.getElementById('birth_certificate').addEventListener('change', function(event) {
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
const applicantTradeType = "{{ $applied_applicant->trade_type }}";
const hideSubFieldBranchIds = @json($hideSubFieldsBranchIds);
const preselectedSubBranchIds = @json($applied_applicant->sub_branch_ids ?? []);
const preselectedSubSubBranchIds = @json($applied_applicant->sub_sub_branch_ids ?? []);

$(document).ready(function () {
  const $branch = $('#branch');
    const $subBranch = $('#sub_branch');
    const $subSubBranch = $('#sub_sub_branch');

    function toggleSubFields(show) {
        $('#subBranchWrapper').toggleClass('d-none', !show);
        $('#subSubBranchWrapper').toggleClass('d-none', !show);
    }

    // Show/hide subfields on load
    if (applicantTradeType === 'NON-TRADESMEN') {
        toggleSubFields(false);
    }

    // Trigger on form submit to alert if missing
    $('form').on('submit', function (e) {
        const branchId = parseInt($branch.val());
        const requiresSubBranch = !hideSubFieldBranchIds.includes(branchId);
        const selectedSubBranches = $subBranch.val() ?? [];
        const selectedSubSubBranches = $subSubBranch.val() ?? [];

        if (requiresSubBranch && selectedSubBranches.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Sub Branch Required',
                text: 'Please select at least one Sub Branch.',
            });
            $subBranch.focus();
            return false;
        }

        if (requiresSubBranch && selectedSubBranches.length > 0 && selectedSubSubBranches.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Certification Required',
                text: 'Please select at least one Certification.',
            });
            $subSubBranch.focus();
            return false;
        }
    });


    // function toggleSubFields(show) {
    //     $('#subBranchWrapper').toggleClass('d-none', !show);
    //     $('#subSubBranchWrapper').toggleClass('d-none', !show);
    // }

    // if (applicantTradeType === 'NON-TRADESMEN') {
    //     toggleSubFields(false);
    // }

    $('#branch').on('change', function () {
        const branchId = parseInt($(this).val());

        if (hideSubFieldBranchIds.includes(branchId)) {
            toggleSubFields(false);
            return;
        }

        toggleSubFields(true);

        $('#sub_branch').empty().html('<option value="">Loading...</option>');
        $('#sub_sub_branch').empty().html('<option value="">Select Sub Sub Branch</option>');

        $.get('/applicant/get-sub-branches/' + branchId, function (subBranches) {
            $('#sub_branch').empty();

            $.each(subBranches, function (i, sb) {
                $('#sub_branch').append(`<option value="${sb.id}">${sb.sub_branch}</option>`);
            });

          // Delay slightly to ensure DOM is updated
    setTimeout(() => {
    if ($.fn.select2 && $('#sub_branch').hasClass("select2-hidden-accessible")) {
        $('#sub_branch').select2('destroy');
    }

    $('#sub_branch').select2({
        placeholder: "Select Sub Branch",
        allowClear: true,
        width: '100%'
    });

    // Ensure options are fully added before setting value
    if (preselectedSubBranchIds.length > 0) {
        preselectedSubBranchIds.forEach(id => {
            $('#sub_branch option[value="' + id + '"]').attr('selected', true);
        });
        $('#sub_branch').trigger('change');
    }
}, 100); // slight delay ensures all <option>s are rendered
            // Preselect saved Sub Branch IDs
            if (preselectedSubBranchIds.length > 0) {
                $('#sub_branch').val(preselectedSubBranchIds).trigger('change');
            }
            // Sub Branch -> Load Sub Sub Branch

$('#sub_branch').off('change').on('change', function () {
    const selectedSubBranchIds = $(this).val();
    $('#sub_sub_branch').empty();
    let allSubSubBranches = [];

    let loadCount = 0;
    let total = selectedSubBranchIds.length;

    if (!total) {
        $('#subSubBranchWrapper').addClass('d-none');
        return;
    }

    selectedSubBranchIds.forEach(function (subBranchId) {
        $.get('/applicant/get-sub-sub-branches/' + subBranchId, function (subSubBranches) {
            loadCount++;

            subSubBranches.forEach(function (ssb) {
                if (!allSubSubBranches.find(e => e.id === ssb.id)) {
                    allSubSubBranches.push(ssb);
                }
            });

            if (loadCount === total) {
                $('#sub_sub_branch').empty(); // Clear once before appending
                if (allSubSubBranches.length > 0) {
                    $('#subSubBranchWrapper').removeClass('d-none');

                    allSubSubBranches.forEach(function (ssb) {
                        $('#sub_sub_branch').append(`<option value="${ssb.id}">${ssb.sub_sub_branch}</option>`);
                    });

                    if ($.fn.select2 && $('#sub_sub_branch').hasClass("select2-hidden-accessible")) {
                        $('#sub_sub_branch').select2('destroy');
                    }

                    $('#sub_sub_branch').select2({
                        placeholder: "Select Sub Sub Branch",
                        allowClear: true,
                        width: '100%'
                    });

                    if (preselectedSubSubBranchIds.length > 0) {
                        $('#sub_sub_branch').val(preselectedSubSubBranchIds).trigger('change');
                    }
                } else {
                    $('#subSubBranchWrapper').addClass('d-none');
                }
            }
        });
    });
});


 // $('#sub_branch').off('change').on('change', function () {
            //     const selectedSubBranchIds = $(this).val();
            //     $('#sub_sub_branch').empty();
            //     let allSubSubBranches = [];

            //     let loadCount = 0;
            //     let total = selectedSubBranchIds.length;
            //     if (!total) {
            //         $('#subSubBranchWrapper').addClass('d-none');
            //         return;
            //     }
            //     selectedSubBranchIds.forEach(function (subBranchId) {
            //         $.get('/applicant/get-sub-sub-branches/' + subBranchId, function (subSubBranches) {
            //             loadCount++;

            //             if (subSubBranches.length > 0) {
            //                 subSubBranches.forEach(function (ssb) {
            //                     if (!allSubSubBranches.some(e => e.id === ssb.id)) {
            //                         allSubSubBranches.push(ssb);
            //                     }
            //                 });
            //             }

            //             if (loadCount === total) {
            //                 if (allSubSubBranches.length > 0) {
            //                     $('#subSubBranchWrapper').removeClass('d-none');

            //                     allSubSubBranches.forEach(function (ssb) {
            //                         $('#sub_sub_branch').append(`<option value="${ssb.id}">${ssb.sub_sub_branch}</option>`);
            //                     });

            //                     // Re-init Select2 for Sub Sub Branch
            //                     if ($.fn.select2 && $('#sub_sub_branch').hasClass("select2-hidden-accessible")) {
            //                         $('#sub_sub_branch').select2('destroy');
            //                     }

            //                     $('#sub_sub_branch').select2({
            //                         placeholder: "Select Sub Sub Branch",
            //                         allowClear: true,
            //                         width: '100%'
            //                     });

            //                     // Preselect saved Sub Sub Branch IDs
            //                     if (preselectedSubSubBranchIds.length > 0) {
            //                         $('#sub_sub_branch').val(preselectedSubSubBranchIds).trigger('change');
            //                     }

            //                 } else {
            //                     $('#subSubBranchWrapper').addClass('d-none');
            //                     $('#sub_sub_branch').empty();
            //                 }
            //             }
            //         });
            //     });
            // });


            // If we had preselected sub branches, trigger loading sub-sub branches
            if (preselectedSubBranchIds.length > 0) {
                $('#sub_branch').trigger('change');
            }
        });
    });

    // Trigger on page load if branch already selected
    const selectedBranchId = $('#branch').val();
    if (selectedBranchId) {
        $('#branch').trigger('change');
    }
});
</script>


<script>
    $(document).ready(function() {
        $('#sub_branch').select2({
            placeholder: "Select Sub Branch",
            allowClear: true,
            width: '100%' // very important!
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#sub_sub_branch').select2({
            placeholder: "Select Sub Sub Branch",
            allowClear: true,
            width: '100%' // very important!
        });
    });
</script>


{{--
<script>
    $(document).ready(function () {
        // When Branch changes, load Sub Branches
        $('#branch').on('change', function () {
            var branchId = $(this).val();
            $('#sub_branch').empty().append('<option value="">Loading...</option>');
            $('#sub_sub_branch').empty().append('<option value="">Select Sub Sub Branch</option>');
            if (branchId) {
                $.ajax({
                    url: '/applicant/get-sub-branches/' + branchId,
                    type: 'GET',
                    success: function (data) {
                        $('#sub_branch').empty().append('<option value="">Select Sub Branch</option>');
                        $.each(data, function (key, value) {
                            $('#sub_branch').append('<option value="' + value.id + '">' + value.sub_branch + '</option>');
                        });
                    }
                });
            }
        });

        // When Sub Branch changes, load Sub Sub Branches
        $('#sub_branch').on('change', function () {
            var subBranchId = $(this).val();
            $('#sub_sub_branch').empty().append('<option value="">Loading...</option>');
            if (subBranchId) {
                $.ajax({
                    url: '/applicant/get-sub-sub-branches/' + subBranchId,
                    type: 'GET',
                    success: function (data) {
                        $('#sub_sub_branch').empty().append('<option value="">Select Sub Sub Branch</option>');
                        $.each(data, function (key, value) {
                            $('#sub_sub_branch').append('<option value="' + value.id + '">' + value.sub_sub_branch + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>

<script>
    const applicantTradeType = "{{ $applied_applicant->trade_type }}";
</script>
<script>
    $(document).ready(function () {
        if (applicantTradeType === 'NON-TRADESMEN') {
            $('#subBranchWrapper').hide();
            $('#subSubBranchWrapper').hide();
        } else {
            $('#subBranchWrapper').show();
            $('#subSubBranchWrapper').show();
        }
    });
</script> --}}

@endsection
