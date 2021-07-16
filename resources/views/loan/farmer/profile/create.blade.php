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
                                        <input name="first_name" type="text" class="form-control required" id="first_name">
                                        <label for="first_name">First name *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="middle_name" type="text" class="form-control required" id="middle_name">
                                        <label for="middle_name">Middle name *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="last_name" type="text" class="form-control required" id="last_name">
                                        <label for="last_name">Last name *</label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input name="date-of-birth" type="text" class="form-control required" id="date-of-birth">
                                                <label for="date-of-birth">Date of Birth *</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input name="age" type="text" class="form-control required" id="age" readonly>
                                                <label for="age">Age</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <select name="civil-status" class="form-control required">
                                                    <option value="">Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widow/er">Widow/er</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
{{--                                                <label for="civil-status" class="check-labels">Civil Status *</label>--}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <select name="gender" class="form-control required">
                                                    <option value="">Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
{{--                                                <label for="gender">Gender *</label>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="land-line" type="text" class="form-control" id="land-line">
                                                <label for="land-line">Land Line</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="mobile" type="text" class="form-control required" id="mobile">
                                                <label for="">Mobile *</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="tin" type="text" class="form-control" id="tin">
                                                <label for="tin">Tin No.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input name="sss-gsis" type="text" class="form-control required" id="sss-gsis">
                                                <label for="sss-gsis">SSS / GSIS No. *</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </fieldset>
                        <h1>Background</h1>
                        <fieldset>
                            <h2>Secondary Information</h2>
                            <div class="row">
                                <div class="col-lg-6 div-box">
                                    <div class="form-group">
                                        <textarea name="address-current" class="form-control no-resize" required id="address-current"></textarea>
                                        <label id="address-current">Current Address *</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input name="farm_lot" type="text" class="form-control required" id="farm_lot">
                                                <label for="farm_lot">Years at Residence *</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <select name="resident-status" id="resident-status" class="form-control required">
                                                    <option value="">Residence Status *</option>
                                                    <option value="Rented">Rented</option>
                                                    <option value="Owned (Mortgaged)">Owned (Mortgaged)</option>
                                                    <option value="Owned (Not Mortgaged)">Owned (Not Mortgaged)</option>
                                                    <option value="Living with parents / free use">Living with parents / free use</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="education" class="form-control required">
                                            <option value="">Education *</option>
                                            <option value="High School">High School</option>
                                            <option value="College">College</option>
                                            <option value="Post Graduate">Post Graduate</option>
                                            <option value="Under Graduate">Under Graduate</option>
                                            <option value="Vocational">Vocational</option>
                                        </select>
                                    </div>

                                    <h3 class="">Dependents</h3>

                                    <div id="dependent-box">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <input name="dependent-name[]" type="text" class="form-control required">
                                                    <label>Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input name="dependent-age[]" type="text" class="form-control required">
                                                    <label>Age</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-right">
                                        <button type="button" class="btn btn-sm btn-success">Add</button>
                                    </div>

                                </div>
                            </div>

                        </fieldset>

                        <h1>Affiliation</h1>
                        <fieldset>
                            <h2>Membership / Group</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input name="farm_lot" type="text" class="form-control required" id="farm_lot">
                                        <label for="farm_lot">Farm Lot *</label>
                                    </div>
                                    <div class="form-group">
                                        <input name="farming_since" type="text" class="form-control required" id="farming_since">
                                        <label for="farming_since">Farming since *</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="i-checks">
                                            <label class="check-labels">{{ Form::checkbox('four_ps', 1) }}<i></i> 4P's</label>
                                        </div>
                                        <div class="i-checks">
                                            <label class="check-labels">{{ Form::checkbox('pwd', 1) }}<i></i> PWD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
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
                    var form = $(this);
                    // Submit form input
                    form.submit();
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

            $(document).on('change', '#resident-status', function(){
                if($(this).val() === 'Rented'){
                    $(this).closest('.div-box').append('' +
                        '<div id="landlord-box">' +
                            '<div class="form-group">' +
                                '<textarea name="landlord-address" class="form-control no-resize" required id="landlord-address"></textarea>' +
                                '<label for="landlord-address">Landlords address if rented *</label>' +
                            '</div>' +
                            '<div class="form-group">' +
                                '<input name="landlord-number" type="text" class="form-control required" id="landlord-number">' +
                                '<label for="landlord-number">Landlords contact number *</label>' +
                            '</div>' +
                        '</div>' +
                    '');
                }else{
                    $('#landlord-box').remove();
                }

            });

            $(document).on('change', '#date-of-birth', function(){
                var dob = moment($(this).val());
                $('input[name=age]').val(moment().diff(dob, 'years'));
            });

            $('input[name=date-of-birth]').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "mm/dd/yyyy"
            });

            function submitForm(){
                var forms = new Array();

            }

        });
    </script>
@endsection
