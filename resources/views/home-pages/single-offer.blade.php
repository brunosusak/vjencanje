@extends('layouts.app')

@section('content')
<div class="style-content container">
    <div class="row">
        <div class="card" style="width: 100%;">
            <img class="card-img-top" src="{{ asset('uploads/'.$offer->offer_image) }}" alt="Card image cap">
            <div class="card-body" style="text-align: center;">
                <h1 class="card-title">{{$offer->name}}</h1>
                <p class="card-text">{{$offer->description}}</p>
                <h3>{{$offer->offer_price}} KM</h3>
            </div>
        </div>
    </div>

</div>

@endsection