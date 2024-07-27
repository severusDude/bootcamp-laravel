<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        $totalNews = News::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalNews', 'totalCategories', 'totalUsers'));
    }
}
