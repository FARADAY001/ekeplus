<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProducerController extends Controller
{
    //
    public function ProducerDashboard(){

        return view('producer.index');

    }

    public function ProducerLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/producer/login');
    } // End Method


    public function ProducerLogin(){
        return view('producer.producer_login');
    } // End Method

    public function ProducerProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('producer.producer_profile_view',compact('profileData'));
    }// End Method


    public function ProducerProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/producer_images/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/producer_images'),$filename);
           $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Mise à jour réussie du profil du producteur',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function ProducerChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('producer.producer_change_password',compact('profileData'));

    }// End Method


    public function ProducerPasswordUpdate(Request $request){

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'L\'ancien mot de passe ne correspond pas !',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        /// Update The new Password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Modification du mot de passe réussie',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }// End Method



}
