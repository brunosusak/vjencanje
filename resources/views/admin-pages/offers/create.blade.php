@extends('layouts.admin')

@section('content')
    <form action="{{route('create-offer')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="offerName">Ime ponude</label>
            <input type="text" class="form-control" name="offer_name" id="offerName" placeholder="Iznajmljujem automobil za svadbene prilike">
        </div>
        <div class="form-group">
            <label for="offerType">Vrsta ponude</label>
            <select name="offer_type_id">
                @foreach($offer_types as $offer_type)
                    <option value="{{$offer_type->id}}">{{$offer_type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="offerPrice">Cijena</label>
            <input type="number" class="form-control" name="offer_price" id="offerPrice" placeholder="Cijene u KM">
        </div>
        <div class="form-group">
            <label for="offerDate">Datum ponude</label>
            <input type="date" class="form-control" name="available_date" id="offerDate" placeholder="Za koji datum ?">
        </div>
        <div class="form-group">
            <label for="offerDescription">Opis ponude</label>
            <textarea class="form-control" name="offer_desc" id="offerDescription" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="offerImage">Slika ponude</label>
            <input type="file" class="form-control-file" name="offer_image" id="offerImage">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Napravi ponudu</button>
    </form>
@endsection