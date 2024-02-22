<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Movies;
use Nette\Utils\Image;
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

    public function StoreMovie(Request $request){

        $request->validate([
            'video' => 'required|mimes:mp4|max:10000',
            'trailer' => 'required|mimes:mp4|max:1000',
        ]);

        $actor_image = $request->file('actor_image');
        $actor_image_name_gen = hexdec(uniqid()).'.'.$actor_image->getClientOriginalExtension();
        Image::make($actor_image)->resize(370,246)->save('upload/movie/actor_image/'.$actor_image);
        $actor_image_save_url = 'upload/movie/actor_image/'.$actor_image_name_gen;

        $producer_image = $request->file('producer_image');
        $producer_image_name_gen = hexdec(uniqid()).'.'.$producer_image->getClientOriginalExtension();
        Image::make($producer_image)->resize(370,246)->save('upload/movie/producer_image/'.$producer_image);
        $producer_image_save_url = 'upload/movie/producer_image/'.$producer_image_name_gen;

        $movie_logo = $request->file('movie_logo');
        $movie_logo_name_gen = hexdec(uniqid()).'.'.$movie_logo->getClientOriginalExtension();
        Image::make($movie_logo)->resize(370,246)->save('upload/movie/movie_logo/'.$movie_logo);
        $movie_logo_save_url = 'upload/movie/movie_logo/'.$movie_logo_name_gen;

        $landscape_image = $request->file('landscape_image');
        $landscape_image_name_gen = hexdec(uniqid()).'.'.$landscape_image->getClientOriginalExtension();
        Image::make($landscape_image)->resize(370,246)->save('upload/movie/landscape_image/'.$landscape_image);
        $landscape_image_save_url = 'upload/movie/landscape_image/'.$landscape_image_name_gen;

        $portrait_image = $request->file('portrait_image');
        $portrait_image_name_gen = hexdec(uniqid()).'.'.$portrait_image->getClientOriginalExtension();
        Image::make($actor_image)->resize(370,246)->save('upload/movie/portrait_image/'.$portrait_image);
        $portrait_image_save_url = 'upload/movie/portrait_image/'.$portrait_image_name_gen;

        //
        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/movie/video/'),$videoName);
        $save_video = 'upload/movie/video/'.$videoName;

        $trailer = $request->file('trailer');
        $trailerName = time().'.'.$trailer->getClientOriginalExtension();
        $video->move(public_path('upload/movie/video/'),$trailerName);
        $save_trailer = 'upload/movie/trailer/'.$trailerName;

        $movie_id = Movies::insertGetId([

            'category_id' => $request->category_id,
            'producer_id' => Auth::user()->id,
            'title' => $request->title,
            'actors' => $request->actors,
            //'slug' => strtolower(str_replace(' ', '-', $request->movie_name)),
            'description' => $request->description,
            'video' => $save_video,
            'trailer' => $save_trailer,

            'country' => $request->country,
            'duration' => $request->duration,

            'producer' => $request->producer,

            'actor_image' => $actor_image_save_url,
            'producer_image' => $producer_image_save_url,
            'movie_logo' => $movie_logo_save_url,
            'landscape_image' => $landscape_image_save_url,
            'portrait_image' => $portrait_image_save_url,


            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'film inséré avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.movie')->with($notification);

    }// End Method




}
