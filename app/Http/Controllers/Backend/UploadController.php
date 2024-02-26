<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Http\RedirectResponse;
use Mostafaznv\Larupload\Larupload;
use Carbon\Carbon;

class UploadController extends Controller
{
    //

    public function AddUp(){

        return view('producer.movies.add_Up');

    }// End Method


    public function storeUp(Request $request): RedirectResponse
    {

        /*
        $main_file = $request->file('main_file');
        $upload = Larupload::init('upload/movie/test/')->upload($main_file);
        
        Upload::insertGetId([

            'main_file' => $request-> $upload,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'film inséré avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.movie')->with($notification);
        */
        $upload = new Upload;
        $upload->main_file = $request->file('file');
        $upload->save();

        $notification = array(
            'message' => 'film inséré avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.movie')->with($notification);
    }
}
