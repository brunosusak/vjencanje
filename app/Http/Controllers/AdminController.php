<?php

namespace App\Http\Controllers;

use App\Offers;
use App\OfferType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin-middleware');
    }

    public function index()
    {
        return view('admin-pages.index');
    }

    public function UserList()
    {
        $users = DB::table('users')
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->select('roles.name as role_name', 'users.name as user_name', 'users.id', 'users.email', 'users.role_id')
                    ->get();

        return view('admin-pages.users', compact('users'));
    }

    public function SetAsAdmin(Request $request)
    {
        $user_id = $request['user_id'];

        User::where('id', $user_id)->update(['role_id' => 2]);

        return back();
    }

    public function getAllOffers()
    {
        $offers = Offers::all();

        return view('admin-pages.offers.all', compact('offers'));
    }

    public function getOffersCreateTemplate()
    {
        $offer_types = OfferType::all();

        return view('admin-pages.offers.create', compact('offer_types'));
    }

    public function createOffer(Request $request)
    {

        $file = $request->file('offer_image');
        $file_name = '';

        if ( $file != null ){
            $file_name = $file->getClientOriginalName();
            $file->move(base_path().'/public/uploads/', $file_name);
        }

        $offer = new Offers;
        $offer->name = $request["offer_name"];
        $offer->offer_type_id = $request["offer_type_id"];
        $offer->description = $request["offer_desc"];
        $offer->available_date = $request["available_date"];
        $offer->offer_price = $request["offer_price"];
        $offer->user_id = Auth::user()->id;
        $offer->offer_image = $file_name;

        $offer->save();

        return back();
    }

    public function getOffersById($offer_type_id) {
        $offers = Offers::where('offer_type_id', '=', $offer_type_id)->get();

        return view('home-pages.offers', compact('offers'));
    }

    public function getSingleOffer($offer_id) {
        $offer = Offers::where('id', '=', $offer_id)->first();
        $offer_type = OfferType::where('id', '=', $offer->offer_type_id)->pluck('name')->first();

        return view('home-pages.single-offer', compact('offer', 'offer_type'));
    }

    public function deleteOffer($offer_id)
    {
        DB::table("offers")->where('id','=', $offer_id)->delete();

        return back();
    }
}
