@extends('layouts.app')

@section('style')
    <style type="text/css">
        .checkmark-center {
            text-align: center;
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

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $products->image }}" class="img-fluid animated animated fadeInLeft" alt="product">
        </div>
        <div class="col-md-6">
            <div class="container-fluid animated fadeInRight">
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
                <div id="zipBody" class="row question-body animated fadeInLeft" style="display: none;">
                    <div class="col-md-12">
                        <h3 class="d-flex justify-content-center">Fill in your ZIP code:</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="ZIP code" aria-label="ZIP code" aria-describedby="button-addon2" maxlength="5" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="zipNext">NEXT</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="checkmarkBody" class="row question-body" style="display: none;">
                    <div class="col-md-12">
                        <div class="checkmark-center">
                            <div class="circle-loader">
                                <div class="checkmark draw"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".question-body:first").show();
        $(".answer").click(function(){
            var answer = $(this).attr('id').replace("answer", "");
            $("#question"+answer).hide();
            $("#question"+answer).next().show();
        });
        $("#zipNext").click(function(){
            $("#zipBody").hide();
            $("#zipBody").next().show();
        });
    });
</script>
@endsection