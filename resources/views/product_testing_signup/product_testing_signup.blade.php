@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $products->image }}" class="img-fluid animated animated fadeInLeft" alt="product">
        </div>
        <div class="col-md-6">
            <div class="container-fluid">
                @foreach($questions as $question)
                    <div>
                        <div><h3 class="d-flex justify-content-center">{{ $question->question }}</h3></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection