@extends('layouts.app')

@section('title')
    {{ "Admin" }}
@endsection

@section('style')
    <style type="text/css">
        .productShow {
            cursor: pointer;
        }
        #productAdd {
        	margin-bottom: 10px;
        }
    </style>
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	        	<button id="productAdd" type="button" class="btn btn-outline-primary float-right">Add</button>
	        	<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Product Name</th>
							<th scope="col">Iamge URL</th>
							<th scope="col">Title</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php $cnt=1 ?>
						@foreach($products as $product)
							<tr class="productShow" productId="{{ $product->id }}">
								<th scope="row">{{ $cnt }}</th>
								<td>{{ $product->name }}</td>
								<td>{{ $product->image }}</td>
								<td>{{ $product->title }}</td>
								<td>
									<form method="POST" action="/admin/products/{{ $product->id }}">
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
	<script type="text/javascript">
        $(document).ready(function(){
        	var productShow = 0;
        	$('.delete').confirmation({
	        	onConfirm: function() {
	        		productShow = 1;
	        		$(this).parents().submit();
	        	}
	        });
        	$(".productShow").click(function(){
        		if(productShow === 0){
	        		var productId = $(this).attr('productId');
	        		location.href = '/admin/products/'+productId;
	        	}
	        	productShow = 0;
        	})
        	$("#productAdd").click(function(){
        		location.href = '/admin/products/create';
        	});
        });
    </script>
@endsection