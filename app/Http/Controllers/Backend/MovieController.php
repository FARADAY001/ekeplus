<?php

namespace App\Http\Controllers\Backend;

use App\Models\Movies;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

}
