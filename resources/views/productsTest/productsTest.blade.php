@extends('layouts.app')

@section('style')
    <style type="text/css">
        .checkmark-block {
            text-align: center;
            margin-top: 30px;
        }
        .circle-loader {
          margin-bottom: 3.5em;
          border: 1px solid rgba(0, 0, 0, 0.2);
          border-left-color: #5cb85c;
          animation: loader-spin 1.2s infinite linear;
          position: relative;
          display: inline-block;
          vertical-align: top;
          border-radius: 50%;
          width: 7em;
          height: 7em;
        }

        .load-complete {
          -webkit-animation: none;
          animation: none;
          border-color: #5cb85c;
          transition: border 500ms ease-out;
        }

        .checkmark {
          display: none;
        }
        .checkmark.draw:after {
          animation-duration: 800ms;
          animation-timing-function: ease;
          animation-name: checkmark;
          transform: scaleX(-1) rotate(135deg);
        }
        .checkmark:after {
          opacity: 1;
          height: 3.5em;
          width: 1.75em;
          transform-origin: left top;
          border-right: 3px solid #5cb85c;
          border-top: 3px solid #5cb85c;
          content: '';
          left: 1.75em;
          top: 3.5em;
          position: absolute;
        }

        @keyframes loader-spin {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }
        @keyframes checkmark {
          0% {
            height: 0;
            width: 0;
            opacity: 1;
          }
          20% {
            height: 0;
            width: 1.75em;
            opacity: 1;
          }
          40% {
            height: 3.5em;
            width: 1.75em;
            opacity: 1;
          }
          100% {
            height: 3.5em;
            width: 1.75em;
            opacity: 1;
          }
        }
    </style>
@endsection

@section('title')
    {{ $products->title }}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $products->image }}" class="img-fluid mx-auto d-block animated bounceInLeft" alt="product">
            </div>
            <div class="col-md-6">
                <div class="container-fluid animated bounceInRight">
                    @foreach($questionData as $data)
                        <div id="question{{ $data[0]->id }}" class="row question-body" style="display: none;">
                            <div class="col-md-12">
                                <h3 class="d-flex justify-content-center">{{ $data[0]->question }}</h3>
                            </div>
                            <div class="col-md-12">
                                @foreach($data[1] as $answer)
                                    <button id="answer{{ $answer->question_id }}" type="button" class="btn btn-primary btn-lg btn-block answer">{{ $answer->answer }}</button>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div id="zipBody" class="row question-body animated bounceInLeft" style="display: none;">
                        <div class="col-md-12">
                            <h3 class="d-flex justify-content-center">Fill in your ZIP code:</h3>
                        </div>
                        <div class="col-md-12">
                            <form class="zip-validation" novalidate>
                                <div class="input-group mb-3">
                                    <input id="zipCode" type="text" class="form-control" placeholder="ZIP code" aria-label="ZIP code" pattern="\d*" maxlength="5" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="zipNext">NEXT</button>
                                    </div>
                                    <div class="invalid-feedback">
                                        Please provide a exact valid ZIP code.
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="checkmarkBody" class="row question-body animated bounceInLeft" style="display: none;">
                        <div class="col-md-12">
                            <div class="checkmark-availability">
                                <h3 class="d-flex justify-content-center">Checking your availability</h3>
                            </div>
                            <div class="checkmark-congratulation animated fadeIn" style="display: none;">
                                <h3 class="d-flex justify-content-center">Congratulations!</h3>
                                <h4 class="d-flex justify-content-center">You are selected!</h4>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkmark-block">
                                <div class="circle-loader">
                                    <div class="checkmark draw"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="fieldBody" class="row question-body animated bounceInLeft" style="display: none;">
                        <div class="col-md-12">
                            <h3 class="d-flex justify-content-center">Fill in your details to continue</h3>
                        </div>
                        <div class="col-md-12">
                            <form class="field-validation" novalidate>
                                <label class="my-1 mr-2">Date of Birth</label>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <select class="custom-select my-1 mr-sm-2" id="month" required>
                                            <option value="">MM</option>
                                            @foreach($months as $month)
                                                <option value="1">{{ $month }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <select class="custom-select my-1 mr-sm-2" id="day" required>
                                            <option value="">DD</option>
                                            @for($i=1;$i<=31;$i++)
                                                <option value="1">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <select class="custom-select my-1 mr-sm-2" id="year" required>
                                            <option value="">YYYY</option>
                                            @for($i=$currentYear; $i>=1928; $i--)
                                                <option value="1">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="firstName" placeholder="Your first name" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid first name.
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="lastName" placeholder="Your last name" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid last name.
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid email.
                                    </div>
                                </div>
                                <label class="my-1 mr-2">Mobile number:</label>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_1" maxlength="3" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_2" maxlength="3" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_3" maxlength="4" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="address" placeholder="Street Address" required>
                                    <div class="invalid-feedback">
                                        Please provide a valid Street Address.
                                    </div>
                                </div>
                                <button id="continue" class="btn btn-primary btn-lg btn-block">Continue</button>
                            </form>
                        </div>
                    </div>
                    <div id="phoneConfirm" class="row question-body animated bounceInLeft" style="display: none;">
                        <div class="col-md-12">
                            <h3 class="d-flex justify-content-center">Please confirm and continue:</h3>
                        </div>
                        <div class="col-md-12">
                            <form class="phoneConfirm-validation" novalidate>
                                <label class="my-1 mr-2">Mobile number:</label>
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_1_confirm" maxlength="3" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_2_confirm" maxlength="3" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="phone_cell_3_confirm" maxlength="4" required>
                                    </div>
                                </div>
                                <div class="col-xs-12" compile="terms"><span>By 'opting-in' to the promotion I give my express written consent to​ be contacted by Trusted Consumer, Omni Research​, The Bill Coach, Wellness Center, and other </span><span id="show-sponsors" ng-click="showSponsors()">3rd party partners</span><span> at the number I provided via autodialer, prerecorded voice, and SMS text (standard rates may apply). Your consent is not a condition for the purchase of any goods or services, to avoid calling </span><span id="btn-skip-optin" ng-click="skipOptIn()">click here</span><span>. I also agree to the sites </span><a href="http://sweepstakescentralusa.com/us/promotional-terms/" target="blank">Terms of Service</a><span> and </span><a href="http://sweepstakescentralusa.com/us/privacy-policy/" target="blank">Privacy statement</a><span> and in doing so, understand that Sweepstakes Central USA and LivingLargeSweeps will be sending me relevant third-party offers via email. I understand that checking this box constitutes my signature.</span></div>
                                <button id="phoneAgree" class="btn btn-primary btn-lg btn-block">I agree</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var data = {};
        function checkmark() {
            setTimeout(
                function(){
                    $('.checkmark-availability').hide()
                    $('.checkmark-congratulation').show()
                    $('.circle-loader').toggleClass('load-complete');
                    $('.checkmark').toggle();
                    setTimeout(function(){
                        $("#checkmarkBody").hide();
                        $("#checkmarkBody").next().show();
                    }, 2500);
                },
            4000);
        }
        $(document).ready(function(){
            $(".question-body:first").show();
            $(".answer").click(function(){
                var answer = $(this).attr('id').replace("answer", "");

                $("#question"+answer).hide();
                $("#question"+answer).next().show();
            });
            $("#zipNext").click(function(){
                var zip_forms = document.getElementsByClassName('zip-validation');
                var zip_validation = Array.prototype.filter.call(zip_forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                            data['zipCode'] = $("#zipCode").val();
                            $("#zipBody").hide();
                            $("#zipBody").next().show();
                            checkmark();
                        }
                        else {
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            });
            $("#continue").click(function(){
                var forms = document.getElementsByClassName('field-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                            var month = $("#month").val();
                            var day = $("#day").val();
                            var year = $("#year").val();
                            var birthday = month+"/"+day+"/"+year;
                            data['birthday'] = birthday;
                            data['firstName'] = $("#firstName").val();
                            data['lastName'] = $("#lastName").val();
                            data['email'] = $("#email").val();
                            data['phone_cell_1'] = $("#phone_cell_1").val();
                            data['phone_cell_2'] = $("#phone_cell_2").val();
                            data['phone_cell_3'] = $("#phone_cell_3").val();
                            data['address'] = $("#address").val();
                            $("#phone_cell_1_confirm").val(data.phone_cell_1);
                            $("#phone_cell_2_confirm").val(data.phone_cell_2);
                            $("#phone_cell_3_confirm").val(data.phone_cell_3);
                            $("#fieldBody").hide();
                            $("#fieldBody").next().show();
                        }
                        else {
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            });
            $("#phoneAgree").click(function(){
                var phoneConfirm_forms = document.getElementsByClassName('phoneConfirm-validation');
                var phoneConfirm_validation = Array.prototype.filter.call(phoneConfirm_forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                            data['phone_cell_1'] = $("#phone_cell_1_confirm").val();
                            data['phone_cell_2'] = $("#phone_cell_2_confirm").val();
                            data['phone_cell_3'] = $("#phone_cell_3_confirm").val();
                        }
                        else {
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            });
        });
    </script>
@endsection