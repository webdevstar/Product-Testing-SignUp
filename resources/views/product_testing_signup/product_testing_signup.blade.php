@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ $products->image }}" class="img-fluid animated animated fadeInLeft" alt="product">
        </div>
        <div class="col-md-6">
            <div class="container-fluid">
                @foreach($questionData as $data)
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="d-flex justify-content-center">{{ $data[0]->question }}</h3>
                        </div>
                        <div class="col-md-12">
                            @foreach($data[1] as $answer)
                                <button type="button" class="btn btn-primary btn-lg btn-block">{{ $answer->answer }}</button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection