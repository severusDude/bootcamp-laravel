<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $attrs = ['title' => 'Homepage'];

        return view('homepage', $attrs);
    }
}
