<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offers;

class MainController extends Controller
{
    public function home()
    {
        return view('home-pages.home');
    }

    public function getOffersById($offer_type_id) {
        $offers = Offers::where('offer_type_id', '=', $offer_type_id)->get();

        return view('home-pages.offers', compact('offers'));
    }
}
