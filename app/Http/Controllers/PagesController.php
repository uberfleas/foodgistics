<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function home()
    {

	    return view('pages.home');

    }

    public function about()
    {
    	return view('pages.about');
    }

    public function feedback()
    {
    	return view('pages.feedback');
    }
    
}
