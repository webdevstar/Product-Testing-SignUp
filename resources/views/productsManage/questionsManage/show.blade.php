@extends('layouts.app')

@section('title')
    {{ "Admin" }}
@endsection

@section('style')
	<style type="text/css">
	</style>
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">{{ $question->question }}</div>

	                <div class="card-body">
	                    <form class="question-validation" method="POST" action="/admin/products/questions/{{ $question->id }}" novalidate>
	                    	{{ csrf_field() }}
							{{ method_field('PATCH') }}
                            <div class="form-group row">
	                            <label for="question" class="col-md-4 col-form-label text-md-right">Question</label>

	                            <div class="col-md-6">
	                                <input id="question" type="text" class="form-control" name="question" required autofocus value="{{ $question->question }}">
	                                <div class="invalid-feedback">
                                        Please provide a valid question.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="answers">
	                        	<?php $cnt = 0; ?>
		                        @foreach($answers as $answer)
			                        <div class="form-group row">
			                        	<label for="answer" class="col-md-4 col-form-label text-md-right">
			                        		@if($cnt === 0){{ "Answers" }}
			                        		@endif
			                        	</label>
			                            <div class="col-md-6">
			                                <input type="text" class="form-control" name="answer{{ $cnt }}" required autofocus value="{{ $answer->answer }}">
			                                <div class="invalid-feedback">
		                                        Please provide a valid answer.
		                                    </div>
			                            </div>
			                        </div>
			                        <?php $cnt++; ?>
			                    @endforeach
			                    <input id="answerCnt" name="answerCnt" type="hidden" value="{{ $cnt }}">
			                </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                            	<button id="questionAdd" type="button" class="btn btn-primary">
	                                    Add
	                                </button>
	                                <button id="questionRegister" type="submit" class="btn btn-primary" disabled="true">
	                                    Register
	                                </button>
	                                <button id="goBack" type="button" class="btn btn-primary">
	                                    Back
	                                </button>
	                            </div>
	                        </div>

                        </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
        $(document).ready(function(){
        	var answerCnt = $("#answerCnt").val();
        	$("#questionAdd").click(function(){
        		$("#questionRegister").removeAttr("disabled");
        		$(".answers").append('<div class="form-group row">'+
				                        	'<label for="answer" class="col-md-4 col-form-label text-md-right"></label>'+
				                            '<div class="col-md-6">'+
				                                '<input type="text" class="form-control" name="answer'+answerCnt+'" required autofocus>'+
				                                '<div class="invalid-feedback">'+
			                                        'Please provide a valid answer.'+
			                                    '</div>'+
				                            '</div>'+
				                    '</div>');
        		answerCnt++;
        		$("#answerCnt").val(answerCnt);
        	});
        	$(".question-validation input").on("change paste keyup", function(){
        		$("#questionRegister").removeAttr("disabled");
        	});
            $("#goBack").click(function(){
            	location.href = '/admin/products/{{ $productID }}';
            });
            $(".questionShow").click(function(){
        		var questionId = $(this).attr('questionId');
        		location.href = '/admin/products/questions/'+questionId;
        	})
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
        });
    </script>
@endsection