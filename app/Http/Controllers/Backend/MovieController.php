<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Movies;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
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

        
        /*
        $request->validate([
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
            'trailer' => 'mimetypes:video/avi,video/mpeg,video/quicktime',
        ]);
        */

        

        /*
        if($request->file('image')){
            
        }
        */

        $manager = new ImageManager(new Driver());

        $actor_image = $request->file('actor_image');
        $actor_image_name_gen = hexdec(uniqid()).'.'.$request->file('actor_image')->getClientOriginalExtension();
        $actor_image = $manager->read($request->file('actor_image'));
        $actor_image = $actor_image->resize(500,500);
        $actor_image->toJpeg(80)->save(base_path('public/upload/movie/actor_image/'.$actor_image_name_gen));
        $actor_image_save_url = 'upload/movie/actor_image/'.$actor_image_name_gen;

        $producer_image = $request->file('producer_image');
        $producer_image_name_gen = hexdec(uniqid()).'.'.$request->file('producer_image')->getClientOriginalExtension();
        $producer_image = $manager->read($request->file('producer_image'));
        $producer_image = $producer_image->resize(500,500);
        $producer_image->toJpeg(80)->save(base_path('public/upload/movie/producer_image/'.$producer_image_name_gen));
        $producer_image_save_url = 'upload/movie/producer_image/'.$producer_image_name_gen;

        $movie_logo = $request->file('movie_logo');
        $movie_logo_name_gen = hexdec(uniqid()).'.'.$request->file('movie_logo')->getClientOriginalExtension();
        $movie_logo = $manager->read($request->file('movie_logo'));
        $movie_logo = $movie_logo->resize(500,500);
        $movie_logo->toJpeg(80)->save(base_path('public/upload/movie/movie_logo/'.$movie_logo_name_gen));
        $movie_logo_save_url = 'upload/movie/movie_logo/'.$movie_logo_name_gen;

        $landscape_image = $request->file('landscape_image');
        $landscape_image_name_gen = hexdec(uniqid()).'.'.$request->file('landscape_image')->getClientOriginalExtension();
        $landscape_image = $manager->read($request->file('landscape_image'));
        $landscape_image = $landscape_image->resize(500,500);
        $landscape_image->toJpeg(80)->save(base_path('public/upload/movie/landscape_image/'.$landscape_image_name_gen));
        $landscape_image_save_url = 'upload/movie/landscape_image/'.$landscape_image_name_gen;

        $portrait_image = $request->file('portrait_image');
        $portrait_image_name_gen = hexdec(uniqid()).'.'.$request->file('portrait_image')->getClientOriginalExtension();
        $portrait_image = $manager->read($request->file('portrait_image'));
        $portrait_image = $portrait_image->resize(500,500);
        $portrait_image->toJpeg(80)->save(base_path('public/upload/movie/portrait_image/'.$landscape_image_name_gen));
        $portrait_image_save_url = 'upload/movie/landscape_image/'.$portrait_image_name_gen;

        //
        $video = $request->file('video');
        $videoName = time().'.'.$video->getClientOriginalExtension();
        $video->move(public_path('upload/movie/video/'),$videoName);
        $save_video = 'upload/movie/video/'.$videoName;

        $trailer = $request->file('trailer');
        $trailerName = time().'.'.$trailer->getClientOriginalExtension();
        $trailer->move(public_path('upload/movie/trailer/'),$trailerName);
        $save_trailer = 'upload/movie/trailer/'.$trailerName;


        //dd("test");
        /*
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
        */
        
        Movies::insertGetId([

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

            'actor_image' => $actor_image_save_url ?? null,
            'producer_image' => $producer_image_save_url ?? null,
            'movie_logo' => $movie_logo_save_url ?? null,
            'landscape_image' => $landscape_image_save_url ?? null,
            'portrait_image' => $portrait_image_save_url ?? null,


            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'film inséré avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.movie')->with($notification);

    }// End Method




}
