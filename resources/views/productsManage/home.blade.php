@extends('layouts.app')

@section('title')
    {{ "Admin" }}
@endsection

@section('style')
    <style type="text/css">
        .productShow {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	        	<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Product Name</th>
							<th scope="col">Iamge URL</th>
							<th scope="col">Title</th>
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
        	$(".productShow").click(function(){
        		var productId = $(this).attr('productId');
        		location.href = '/admin/products/'+productId;
        	})
        });
    </script>
@endsection