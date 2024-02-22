<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    public function AllCategory(){

        $category = Category::latest()->get();
        return view('admin.backend.category.all_category',compact('category'));

    }// End Method

    public function AddCategory(){
        return view('admin.backend.category.add_category');
    }// End Method

    public function StoreCategory(Request $request){


        Category::insert([
            'category_name' => $request->category_name,
        //    'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),

        ]);

        $notification = array(
            'message' => 'Catégorie insérée avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);

    }// End Method


    public function EditCategory($id){

        $category = Category::find($id);
        return view('admin.backend.category.edit_category',compact('category'));
    }// End Method 


    public function UpdateCategory(Request $request){

        $cat_id = $request->id;

        Category::find($cat_id)->update([
            'category_name' => $request->category_name,
            //'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),


        ]);

        $notification = array(
            'message' => 'Mise à jour de la catégorie avec avec succès',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);


    }// End Method

    public function DeleteCategory($id){

        Category::find($id)->delete();

            $notification = array(
                'message' => 'Catégorie supprimée avec succès',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    }// End Method

}
