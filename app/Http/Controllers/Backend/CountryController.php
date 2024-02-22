<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //
    public function AllCountry(){

        $country = Country::latest()->get();
        return view('admin.backend.country.all_country',compact('country'));

    }// End Method

    public function AddCountry(){
        return view('admin.backend.country.add_country');
    }// End Method

    public function StoreCountry(Request $request){


        Country::insert([
            'country_name' => $request->country_name,
        ]);

        $notification = array(
            'message' => 'Pays insérée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.country')->with($notification);

    }// End Method


    public function EditCountry($id){

        $country = Country::find($id);
        return view('admin.backend.country.edit_country',compact('country'));
    }// End Method 


    public function UpdateCountry(Request $request){

        $country_id = $request->id;

        Country::find($country_id)->update([
            'country_name' => $request->country_name,

        ]);

        $notification = array(
            'message' => 'Mise à jour du pays avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.country')->with($notification);


    }// End Method

    public function DeleteCountry($id){

        Country::find($id)->delete();

            $notification = array(
                'message' => 'pays supprimée avec succès',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    }// End Method
}
