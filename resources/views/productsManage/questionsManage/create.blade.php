@extends('layouts.app')

@section('title')
    {{ "Admin" }}
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Question Register</div>

	                <div class="card-body">
	                    <form class="question-validation" method="POST" action="/admin/products/questions" novalidate>
	                    	{{ csrf_field() }}
							{{ method_field('POST') }}
                            <div class="form-group row">
	                            <label for="question" class="col-md-4 col-form-label text-md-right">Question</label>

	                            <div class="col-md-6">
	                                <input id="question" type="text" class="form-control" name="question" required autofocus>
	                                <div class="invalid-feedback">
                                        Please provide a valid question.
                                    </div>
	                            </div>
	                        </div>
	                        <div class="Answers">
		                        <div class="form-group row">
		                            <label for="answer0" class="col-md-4 col-form-label text-md-right">Answers</label>

		                            <div class="col-md-6">
		                                <input id="answer0" type="text" class="form-control" name="answer0" required autofocus>
		                                <div class="invalid-feedback">
	                                        Please provide a valid answer.
	                                    </div>
		                            </div>
		                        </div>
		                    </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button id="addMore" type="button" class="btn btn-primary">
	                                    Add more
	                                </button>
	                                <button id="questionRegister" type="submit" class="btn btn-primary">
	                                    Register
	                                </button>
	                            </div>
	                        </div>

	                        <input type="hidden" id="productId" name="productId" value="{{ $id }}">
	                        <input type="hidden" id="answerCnt" name="answerCnt" value="1">

                        </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
        var answerCnt = 1;
        $(document).ready(function(){
            $("#questionRegister").click(function(){
                var question_forms = document.getElementsByClassName('question-validation');
                var question_validation = Array.prototype.filter.call(question_forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                        	$(".question-validation").submit();
                        }
                        else {
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            });
            $("#addMore").click(function() {
            	$(".Answers").append('<div class="form-group row">'+
			                            '<label for="answer'+answerCnt+'" class="col-md-4 col-form-label text-md-right"></label>'+

			                            '<div class="col-md-6">'+
			                                '<input id="answer'+answerCnt+'" type="text" class="form-control" name="answer'+answerCnt+'" required autofocus>'+
			                                '<div class="invalid-feedback">'+
		                                        'Please provide a valid answer.'+
		                                    '</div>'+
			                            '</div>'+
			                        '</div>');
            	answerCnt++;
            	$("#answerCnt").val(answerCnt);
            });
        });
    </script>
@endsection