<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $title = 'Homepage';
        $categories = collect(Category::all());
        $news = collect(News::all());

        return view('homepage', compact('title', 'categories', 'news'));
    }
}
