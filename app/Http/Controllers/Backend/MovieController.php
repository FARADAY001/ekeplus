<?php

namespace App\Http\Controllers\Backend;

use App\Models\Movies;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MovieController extends Controller
{
    //
    public function AllMovie(){

        $id = Auth::user()->id;
        $movies = Movies::where('producer_id',$id)->orderBy('id','desc')->get();
          return view('producer.movies.all_movies',compact('movies'));

      }// End Method

    public function AddMovie(){

        $categories = Category::latest()->get();
        return view('producer.movies.add_movie',compact('categories'));

    }// End Method

    public function StoreMovie(Request $request){

        $request->validate([
            'video' => 'required|mimes:mp4|max:10000',
        ]);

        $image = $request->file('movie_image');  
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/movie/thambnail/'.$name_gen);
        $save_url = 'upload/movie/thambnail/'.$name_gen;

        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/movie/video/'),$videoName);
        $save_video = 'upload/movie/video/'.$videoName;

    }// End Method


    

}
