
                                                    <div class="form-group row">

                                                            <div class="col-md-4 col-12 mb-3">
                                                                <label for="national_identity_card" class="col-form-label" style="display: block; text-align: left;"><b>National ID (Ghana Card)</b></label>
                                                                <input type="text" class="form-control"
                                                                    id="national_identity_card"
                                                                    name="national_identity_card"
                                                                    placeholder="GHA-123456789-1"
                                                                    maxlength="16"
                                                                    pattern="GHA-\d{9}-\d{1}"
                                                                    title="Format: GHA-XXXXXXXXX-X (e.g., GHA-123456789-1)"
                                                                    required
                                                                    value="{{ old('national_identity_card', $applied_applicant->national_identity_card) }}">
                                                                @error('national_identity_card')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
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


                                                         <h5 class="mt-5">Select Best Six (6) BECE Grades</h5>
                                                       <hr>

                                                       {{-- Join Core and Elective Subjects into a single row, left and right --}}
                                                        <div class="form-group row">
                                                            {{-- Core Subjects (Left) --}}
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    {{-- English Language --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_english" name="bece_english" class="form-control" readonly>
                                                                            <option value="ENGLISH LANGUAGE" {{ old('bece_english', $applied_applicant->bece_english) == 'ENGLISH LANGUAGE' ? 'selected' : '' }}>ENGLISH LANGUAGE</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_english_grade" name="bece_subject_english_grade" class="form-control required">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_english_grade', $applied_applicant->bece_subject_english_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_english_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    {{-- Mathematics --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_mathematics" name="bece_mathematics" class="form-control" readonly>
                                                                            <option value="MATHEMATICS" {{ old('bece_mathematics', $applied_applicant->bece_mathematics) == 'MATHEMATICS' ? 'selected' : '' }}>MATHEMATICS</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_maths_grade" name="bece_subject_maths_grade" class="form-control required">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_maths_grade', $applied_applicant->bece_subject_maths_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_maths_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    {{-- Integrated Science --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_subject_three" name="bece_subject_three" class="form-control" readonly>
                                                                            <option value="INTEGRATED SCIENCE" {{ old('bece_subject_three', $applied_applicant->bece_subject_three) == 'INTEGRATED SCIENCE' ? 'selected' : '' }}>INTEGRATED SCIENCE</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_three_grade" name="bece_subject_three_grade" class="form-control required">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_three_grade', $applied_applicant->bece_subject_three_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_three_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Elective Subjects (Right) --}}
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    {{-- Subject 4 --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_subject_four" name="bece_subject_four" class="form-control">
                                                                            <option value="">Select Subject</option>
                                                                            @foreach ($bece_subject as $subject)
                                                                                <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_four', $applied_applicant->bece_subject_four) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                    {{ $subject->becesubjects }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_four')
                                                                            <span class="text-danger">Subject Duplicated: {{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_four_grade" name="bece_subject_four_grade" class="form-control bece-grade">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_four_grade', $applied_applicant->bece_subject_four_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_four_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    {{-- Subject 5 --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_subject_five" name="bece_subject_five" class="form-control">
                                                                            <option value="">Select Subject</option>
                                                                            @foreach ($bece_subject as $subject)
                                                                                <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_five', $applied_applicant->bece_subject_five) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                    {{ $subject->becesubjects }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_five')
                                                                            <span class="text-danger">Subject Duplicated: {{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_five_grade" name="bece_subject_five_grade" class="form-control bece-grade">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_five_grade', $applied_applicant->bece_subject_five_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_five_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    {{-- Subject 6 --}}
                                                                    <div class="col-md-6 mb-2">
                                                                        <select id="bece_subject_six" name="bece_subject_six" class="form-control">
                                                                            <option value="">Select Subject</option>
                                                                            @foreach ($bece_subject as $subject)
                                                                                <option value="{{ $subject->becesubjects }}" {{ old('bece_subject_six', $applied_applicant->bece_subject_six) == $subject->becesubjects ? 'selected' : '' }}>
                                                                                    {{ $subject->becesubjects }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_six')
                                                                            <span class="text-danger">Subject Duplicated: {{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-md-5 mb-2">
                                                                        <select id="bece_subject_six_grade" name="bece_subject_six_grade" class="form-control bece-grade">
                                                                            <option value="">Grade</option>
                                                                            @foreach ($bece_results as $grade)
                                                                                <option value="{{ $grade->beceresults }}" {{ old('bece_subject_six_grade', $applied_applicant->bece_subject_six_grade) == $grade->beceresults ? 'selected' : '' }}>
                                                                                    {{ $grade->beceresults }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('bece_subject_six_grade')
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
