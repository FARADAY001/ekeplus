<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function AllPayment(){

        return view('admin.backend.category.all_category');

    }// End Method

}