@extends('layouts.app')

@section('title')
    {{ "Admin" }}
@endsection

@section('style')
	<style type="text/css">
		.questionsBody {
			margin-top: 30px;
		}
		.questionShow {
			cursor: pointer;
		}
		#questionAdd {
        	margin-bottom: 10px;
        }
	</style>
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Product</div>

	                <div class="card-body">
	                    <form class="product-validation" method="POST" action="/admin/products/{{ $product->id }}" novalidate>
	                    	{{ csrf_field() }}
							{{ method_field('PATCH') }}
                            <div class="form-group row">
	                            <label for="productName" class="col-md-4 col-form-label text-md-right">Product Name</label>

	                            <div class="col-md-6">
	                                <input id="productName" type="text" class="form-control" name="productName" required autofocus value="{{ $product->name }}">
	                                <div class="invalid-feedback">
                                        Please provide a valid product name.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="productImage" class="col-md-4 col-form-label text-md-right">Product Image URL</label>

	                            <div class="col-md-6">
	                                <input id="productImage" type="url" class="form-control" name="productImage" placeholder="https://example" pattern="https://.*" required autofocus value="{{ $product->image }}">
	                                <div class="invalid-feedback">
                                        Please provide a valid product image URL.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="productTitle" class="col-md-4 col-form-label text-md-right">Product Title</label>

	                            <div class="col-md-6">
	                                <input id="productTitle" type="text" class="form-control" name="productTitle" required autofocus value="{{ $product->title }}">
	                                <div class="invalid-feedback">
                                        Please provide a valid product title.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button id="productRegister" type="submit" class="btn btn-outline-primary" disabled="true">
	                                    Register
	                                </button>
	                                <button id="goBack" type="button" class="btn btn-outline-info">
	                                    Back
	                                </button>
	                            </div>
	                        </div>

                        </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row justify-content-center questionsBody">
	        <div class="col-md-8">
	        	<div class="card">
	                <div class="card-header">Questions</div>

	                <div class="card-body">
	                	<button id="questionAdd" type="button" class="btn btn-outline-primary float-right">Add</button>
	                	<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Question</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<?php $cnt=1 ?>
								@foreach($questions as $question)
									<tr class="questionShow" questionId="{{ $question->id }}">
										<th scope="row">{{ $cnt }}</th>
										<td>{{ $question->question }}</td>
										<td>
											<form method="POST" action="/admin/products/questions/{{ $question->id }}?productID={{ $id }}">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<button type="button" class="btn btn-outline-danger delete">delete</button>
											</form>
										</td>
									</tr>
									<?php $cnt++ ?>
								@endforeach
							</tbody>
						</table>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
        var data = {};
        $(document).ready(function(){
        	var questionShow = 0;
        	$('.delete').confirmation({
	        	onConfirm: function() {
	        		questionShow = 1;
	        		$(this).parents().submit();
	        	}
	        });
        	$(".product-validation input").on("change paste keyup", function(){
        		$("#productRegister").removeAttr("disabled")
        	});
            $("#goBack").click(function(){
            	location.href = '/admin/products';
            });
            $(".questionShow").click(function(){
            	if(questionShow === 0){
	        		var questionId = $(this).attr('questionId');
        			location.href = '/admin/products/questions/'+questionId+'?productID={{ $id }}';
	        	}
	        	questionShow = 0;
        	})
        	$("#productRegister").click(function(){
        		$(".product-validation").submit();
        	});
        	$("#questionAdd").click(function(){
        		location.href = '/admin/products/questions/create?productID={{ $id }}';
        	});
        });
    </script>
@endsection