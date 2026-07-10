<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', ['appTitle' => "from controller"]);
    }

    public function show(Request $req)
    {
        return view('pages.about', ['appTitle' => 'About user IP', 'ip' => '1']);
    }
}
