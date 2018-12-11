@extends('layouts.app')

@section('title')
    {{ "Product Create" }}
@endsection

@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header">Product Register</div>

	                <div class="card-body">
	                    <form class="product-validation" method="POST" action="/admin/products" novalidate>
	                    	{{ csrf_field() }}
							{{ method_field('POST') }}
                            <div class="form-group row">
	                            <label for="productName" class="col-md-4 col-form-label text-md-right">Product Name</label>

	                            <div class="col-md-6">
	                                <input id="productName" type="text" class="form-control" name="productName" required autofocus>
	                                <div class="invalid-feedback">
                                        Please provide a valid product name.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="productImage" class="col-md-4 col-form-label text-md-right">Product Image URL</label>

	                            <div class="col-md-6">
	                                <input id="productImage" type="url" class="form-control" name="productImage" placeholder="https://example" pattern="https://.*" required autofocus>
	                                <div class="invalid-feedback">
                                        Please provide a valid product image URL.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row">
	                            <label for="productTitle" class="col-md-4 col-form-label text-md-right">Product Title</label>

	                            <div class="col-md-6">
	                                <input id="productTitle" type="text" class="form-control" name="productTitle" required autofocus>
	                                <div class="invalid-feedback">
                                        Please provide a valid product title.
                                    </div>
	                            </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-md-6 offset-md-4">
	                                <button id="productRegister" type="submit" class="btn btn-primary">
	                                    Register
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
        var data = {};
        $(document).ready(function(){
            $("#productRegister").click(function(){
                var product_forms = document.getElementsByClassName('product-validation');
                var product_validation = Array.prototype.filter.call(product_forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        if (form.checkValidity() === true) {
                        	$(".product-validation").submit();
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