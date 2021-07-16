@extends('layouts.loan-provider-info')

{{--@section('title', 'Dashboard | '.getRoleName('display_name'))--}}
@section('title', 'Create Profile')

@section('content')

    <main class="page-forms page-register page-farmers">
        <div class="row no-gutters sign-in">
            <div class="col-12 col-lg-4 left d-none d-lg-flex" style="background-image: url({{ asset('images/loan/bg-img.jpg') }})">
                <div class="text">Setup Your Account</div>
            </div>
            <div class="col-12 col-lg-8 right d-flex align-items-center justify-content-center">
                <div class="content w-100">
                    <h1 class="d-block d-lg-none text-center">Setup Your Account</h1>
                    <small>Fill all form field to go next step</small>

                    <form id="form" action="{{ route('farmer-profile-store') }}" method="post" class="wizard-big">
                        @csrf

                        <h1>Profile</h1>
                        <fieldset>
                            <h2>Personal Information</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="first_name" type="text" data-title="First name" class="profile-form form-control required" id="first_name">
                                        <label for="first_name">First name *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="middle_name" type="text" data-title="Middle name" class="profile-form form-control required" id="middle_name">
                                        <label for="middle_name">Middle name *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="last_name" type="text" data-title="Last name" class="profile-form form-control required" id="last_name">
                                        <label for="last_name">Last name *</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input name="dob" type="text" data-title="Date of Birth" class="profile-form form-control required" id="dob">
                                                <label for="dob">Date of Birth *</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input name="age" type="text" class="form-control" id="age" readonly>
                                                <label for="age">Age</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select name="civil_status" data-title="Civil Status" class="profile-form form-control required" id="civil_status">
                                                    <option value="" readonly></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow/er">Widow/er</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                                <label for="civil_status">Civil Status *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select name="gender" data-title="Gender" class="profile-form form-control required" id="gender">
                                                    <option value="" readonly></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <label for="gender">Gender *</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="land-line" type="text" data-title="Land Line" class="profile-form form-control" id="land-line">
                                                <label for="land-line">Land Line</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="mobile" type="text" data-title="Mobile" class="profile-form form-control required" id="mobile">
                                                <label for="mobile">Mobile *</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="tin" type="text" data-title="Tin No." class="profile-form form-control" id="tin">
                                                <label for="tin">Tin No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="sss_gsis" type="text" data-title="SSS / GSIS No." class="profile-form form-control required" id="sss-gsis">
                                                <label for="sss_gsis">SSS / GSIS No. *</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="education" data-title="Education" class="profile-form form-control required" id="education">
                                            <option value="" readonly></option>
                                            <option value="High School">High School</option>
                                            <option value="College">College</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                            <option value="Under Graduate">Under Graduate</option>
                                            <option value="Vocational">Vocational</option>
                                        </select>
                                        <label for="education">Education *</label>
                                    </div>
                                </div>
                            </div>


                            <h2>Secondary Information</h2>
                            <div class="row">
                                <div class="col-lg-6 div-box">
                                    <div class="form-group">
                                        <textarea name="address_current" data-title="Current Address" class="profile-form form-control no-resize" required id="address_current"></textarea>
                                        <label id="address_current">Current Address *</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input name="address_year_stay" data-title="Years of Stay" type="number" class="profile-form form-control required" id="address_year_stay">
                                                <label for="address_year_stay">Years of Stay *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <select name="address_status" data-title="Address Status" id="address_status" class="profile-form form-control required">
                                                    <option value="" readonly></option>
                                                    <option value="Rented">Rented</option>
                                                    <option value="Owned (Mortgaged)">Owned (Mortgaged)</option>
                                                    <option value="Owned (Not Mortgaged)">Owned (Not Mortgaged)</option>
                                                    <option value="Living with parents / free use">Living with parents / free use</option>
                                                </select>
                                                <label for="address_status">Address Status *</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <h3 class="">Dependents</h3>

                                    <div class="repeater-container">
                                        <div class="row header d-none d-lg-flex">
                                            <div class="col-8"><div class="box">Name</div></div>
                                            <div class="col-4"><div class="box">Age</div></div>
                                        </div>
                                        <div class="profile-form repeater-lists" name="dependents" data-title="Dependents" id="dependent-box"></div>
                                        <div class="actions text-right">
                                            <a href="javascript:;" class="btn-add btn-action" data-action="add-dependent">
                                                <img src="https://img.icons8.com/ios-glyphs/30/38c172/plus-math.png"/>
                                            </a> &nbsp;
                                            <a href="javascript:;" class="btn-add btn-action" data-action="remove-dependent">
                                                <img src="https://img.icons8.com/ios-glyphs/30/38c172/minus-math.png"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </fieldset>

                        <h1>More Information</h1>
                        <fieldset>
                            <h2>Spouse/Co-maker</h2>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="spouse_first_name" data-title="First name" type="text" class="profile-form form-control" id="spouse_first_name">
                                        <label for="spouse_first_name">First name</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="spouse_middle_name" data-title="Middle name" type="text" class="profile-form form-control" id="spouse_middle_name">
                                        <label for="spouse_middle_name">Middle name</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="spouse_last_name" data-title="Last name" type="text" class="profile-form form-control" id="spouse_last_name">
                                        <label for="spouse_last_name">Last name</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input name="spouse_date_of_birth" data-title="Date of Birth" type="text" class="profile-form form-control" id="spouse_date-of-birth">
                                                <label for="spouse_date_of_birth">Date of Birth</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input name="spouse_age" data-title="Age" type="text" class="profile-form form-control" id="spouse_age" readonly>
                                                <label for="spouse_age">Age</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select name="spouse_civil-status" data-title="Civil Status" class="profile-form form-control" id="spouse_civil_status">
                                                    <option value="" readonly></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow/er">Widow/er</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                                <label for="spouse_civil_status">Civil Status *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select name="spouse_gender" data-title="Gender" class="profile-form form-control" id="spouse_gender">
                                                    <option value="" readonly></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <label for="spouse_gender">Gender</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="spouse_land_line" data-title="Land Line" type="text" class="profile-form form-control" id="spouse_land-line">
                                                <label for="spouse_land_line">Land Line</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="spouse_mobile" data-title="Mobile" type="text" class="profile-form form-control" id="spouse_mobile">
                                                <label for="spouse_mobile">Mobile</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="spouse_tin" data-title="Tin No." type="text" class="profile-form form-control" id="spouse_tin">
                                                <label for="spouse_tin">Tin No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="spouse_sss_gsis" data-title="SSS / GSIS No." type="text" class="profile-form form-control" id="spouse_sss-gsis">
                                                <label for="spouse_sss_gsis">SSS / GSIS No.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select name="spouse_education" data-title="Education" class="profile-form form-control" id="spouse_education">
                                            <option value="" readonly></option>
                                            <option value="High School">High School</option>
                                            <option value="College">College</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                            <option value="Under Graduate">Under Graduate</option>
                                            <option value="Vocational">Vocational</option>
                                        </select>
                                        <label for="spouse_education">Education</label>
                                    </div>
                                </div>
                            </div>

                            <h2>Membership / Group</h2>
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group">
                                        <input name="farm_lot" type="text" data-title="Farm Lot" class="profile-form form-control required" id="farm_lot">
                                        <label for="farm_lot">Farm Lot *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="farming_since" type="text" data-title="Farming since" class="profile-form form-control required" id="farming_since">
                                        <label for="farming_since">Farming since *</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="i-checks">
                                                    <label class="check-labels">{{ Form::checkbox('four_ps', 1, array('class'=>'')) }}<i></i> 4P's</label>
                                                </div>
                                                <div class="i-checks">
                                                    <label class="check-labels">{{ Form::checkbox('pwd', 1) }}<i></i> PWD</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <div class="i-checks">
                                                    <label class="check-labels">{{ Form::checkbox('indigenous', 1) }}<i></i> Indigenous</label>
                                                </div>
                                                <div class="i-checks">
                                                    <label class="check-labels">{{ Form::checkbox('livelihood', 1) }}<i></i> Livelihood</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </fieldset>


                        <h1>Employment</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="employment_employed" id="employment_employed" class="form-control required">
                                            <option value="" readonly></option>
                                            <option value="Private">Private</option>
                                            <option value="Government">Government</option>
                                        </select>
                                        <label for="employment_employed">Employed *</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="self_employment_employed" id="self_employment_employed" class="form-control required">
                                            <option value="" readonly></option>
                                            <option value="Service">Service</option>
                                            <option value="Agricultural">Agricultural</option>
                                            <option value="Transporation">Transporation</option>
                                            <option value="Manufacturing/Processing">Manufacturing/Processing</option>
                                            <option value="Trading/Merchandising">Trading/Merchandising</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <label for="self_employment_employed">Self-Employed *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <input name="employer_business" type="text" class="form-control" id="employer_business">
                                        <label for="employer_business">Employer Business Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <input name="employer_contact_number" type="text" class="form-control" id="employer_contact_number">
                                        <label for="employer_contact_number">Tel No.</label>
                                    </div>
                                </div>
                            </div>


                            <h3 class="">If Employed:</h3><br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <select name="employed_position" id="employed_position" class="form-control required">
                                            <option value="" readonly></option>
                                            <option value="Staff">Staff</option>
                                            <option value="Professional">Professional</option>
                                            <option value="Office/Manager">Office/Manager</option>
                                            <option value="OFW">OFW</option>
                                            <option value="Trading/Merchandising">Trading/Merchandising</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <label for="employed_position">Position *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <input name="employed_employer_address" type="text" class="form-control" id="employed_employer_address">
                                        <label for="employed_employer_address">Employer/Business Address</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <input name="employed_employer_contact_number" type="text" class="form-control" id="employed_employer_contact_number">
                                        <label for="employed_employer_contact_number">Tel No.</label>
                                    </div>
                                </div>
                            </div>

                        </fieldset>



                        <h1>Monthly Income</h1>
                        <fieldset>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Business</th>
                                        <th>Employment</th>
                                        <th>Total</th>
                                    </tr>
                                    <tr>
                                        <td>Applicant Monthly Income</td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group display_peso">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Spouse's Monthly Income</td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group display_peso">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Other Monthly Income</td>
                                        <td>
                                            <div class="form-group">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Monthly Income</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-group display_peso">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Less Monthly Expenses <small>(Living, Utilitites, rental, transpo..)</small></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Loan Amortization<small>(Mortgage/loan)</small></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total Expenses</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-group">
                                                <input name="" type="number" class="form-control" id="">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="grand-total">
                                        <td>Net Monthly Income</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="form-group display_peso">
                                                <input name="" type="number" class="form-control" id="" value="0.00" readonly>
                                            </div>
                                        </td>
                                    </tr>

                                </table>
                            </div>


                            <div class="repeater-container" id="other_payments">
                                <div class="row header d-none d-lg-flex">
                                    <div class="col-4"><div class="box">Other assets aside from collateral <small>car, rental, real state</small></div></div>
                                    <div class="col-4"><div class="box">Location/Description</div></div>
                                    <div class="col-4"><div class="box">Size(sq.m.) Estimated Value</div></div>
                                </div>
                                <div class="repeater-lists">
                                    <div class="repeater-item">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_assets" class="form-control" placeholder="Other assets aside from collateral">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_location" class="form-control" placeholder="Location/Description">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_size" class="form-control" placeholder="Size(sq.m.) Estimated Value">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="repeater-item">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_assets" class="form-control" placeholder="Other assets aside from collateral">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_location" class="form-control" placeholder="Location/Description">
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <input type="text" name="payment_size" class="form-control" placeholder="Size(sq.m.) Estimated Value">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:;" class="btn-add">
                                            <img src="https://img.icons8.com/ios/30/38c172/plus-math.png"/>
                                        </a>
                                        {{--<a href="javascript:;" class="btn-delete">--}}
                                        {{--<img src="https://img.icons8.com/ios/30/e3342f/minus-math.png"/>--}}
                                        {{--</a>--}}
                                    </div>

                                </div>

                            </div>

                        </fieldset>


                        <h1>Finish</h1>
                        <fieldset>
                            <h2>Terms and Conditions</h2>
                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required i-checks"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </main>


@endsection


@section('styles')
    {{--{!! Html::style('') !!}--}}
    {!! Html::style('/css/app.css') !!}
    {!! Html::style('/css/template/style.css') !!}
    {!! Html::style('/css/template/plugins/iCheck/custom.css') !!}
    {!! Html::style('/css/template/plugins/steps/jquery.steps.css') !!}
    {!! Html::style('/css/template/plugins/datapicker/datepicker3.css') !!}
    {!! Html::style('/css/template/plugins/daterangepicker/daterangepicker-bs3.css') !!}
    {{--{!! Html::style('/js/template/plugins/') !!}--}}
@endsection

@section('scripts')
    {{--{!! Html::script('') !!}--}}

    <script src="{{ URL::to('/js/app.js') }}"></script>
    <script src="{{ URL::to('/js/template/inspinia.js') }}"></script>
    <script src="{{ URL::to('/js/template/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    {!! Html::script('/js/template/plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('/js/template/plugins/steps/jquery.steps.min.js') !!}
    {!! Html::script('/js/template/plugins/validate/jquery.validate.min.js') !!}
    {!! Html::script('/js/template/plugins/slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('/js/template/plugins/datapicker/bootstrap-datepicker.js') !!}
    {!! Html::script('/js/template/plugins/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('/js/template/moment.js') !!}
    {!! Html::script('/js/template/numeral.js') !!}


    <script>
        $(document).ready(function(){
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    submitForm();

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    // Submit form input
                    // var form = $(this);
                    // form.submit();
                    submitForm();
                }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                }
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });

            $(document).on('change', '#address_status', function(){
                if($(this).val() === 'Rented'){
                    if($('#landlord-box').length){
                        $('#landlord-box').remove();
                    }
                    $(this).closest('.div-box').append('' +
                        '<div id="landlord-box">' +
                            '<div class="form-group">' +
                                '<textarea name="landlord_address" class="form-control no-resize" required id="landlord_address"></textarea>' +
                                '<label for="landlord_address">Landlords address if rented *</label>' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<input name="landlord_number" type="text" class="form-control required" id="landlord_number">' +
                                '<label for="landlord_number">Landlords contact number *</label>' +
                            '</div>' +
                        '</div>' +
                    '');
                }else{
                    $('#landlord-box').remove();
                }

            });

            $(document).on('change', '#dob', function(){
                var dob = moment($(this).val());
                $('input[name=age]').val(moment().diff(dob, 'years')).trigger('focus');
                $(this).trigger('focus');
            });

            $(document).on('click', '.btn-action', function(){
                var action = $(this).data('action'), dependentBox = $('#dependent-box');
                switch(action){
                    case 'add-dependent':
                        dependentBox.append('' +
                            '<div class="repeater-item">' +
                                '<div class="row">' +
                                    '<div class="col-12 col-lg-8">' +
                                        '<input type="text" name="dependent-name" class="form-control" placeholder="Name" required>' +
                                    '</div>' +
                                    '<div class="col-12 col-lg-4">' +
                                        '<input type="text" name="dependent-age" class="form-control" placeholder="Age" required>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '');
                        break;
                    case 'remove-dependent':
                        dependentBox.find('.repeater-item').last().remove();
                        break;
                }
            });

            $('input[name=dob]').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "mm/dd/yyyy"
            });

            $(document).on('change', '#spouse_date-of-birth', function(){
                var dob = moment($(this).val());
                $('input[name=spouse_age]').val(moment().diff(dob, 'years')).trigger('focus');
                $(this).trigger('focus');
            });

            $('input[name=spouse_date-of-birth]').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "mm/dd/yyyy"
            });

            function submitForm(){
                var forms = new Array();

                // console.log($('input[name=first_name]').data('text'));

                $('.profile-form').each(function(){
                    var name = $(this).attr('name');
                    var title = $(this).data('title');
                    var value = $(this).val();
                    var values = new Array();
                    if(title === 'Dependents'){
                        console.log('Dependents: ' + $(this).children().length);
                        if($(this).children().length < 1){
                            return false;
                        }
                        var dependent = new Array();
                        $(this).find('.repeater-item').each(function(){
                            var item = new Array();
                            item.push($(this).find('input[name=dependent-name]').val());
                            item.push($(this).find('input[name=dependent-age]').val());
                            dependent.push(item);
                        });
                        value = dependent;
                    }
                    values.push(name);
                    values.push(title);
                    values.push(value);

                    if( (title === 'Address Status') && (value === 'Rented')){
                        var landlord = new Array();
                        landlord.push($('#landlord-box').find('#landlord_address').val());
                        landlord.push($('#landlord-box').find('#landlord_number').val());
                        values.push(landlord);
                    }

                    forms.push(values);
                });

                console.log(forms);
            }

        });
    </script>

@endsection
