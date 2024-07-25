<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->latest()->paginate(5);

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'exists:categories,id',
        ]);

        $news = new News();

        $news->title = $request->title;
        $news->body = $request->body;
        $news->category_id = $request->category_id;

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::with('user', 'category', 'comments')->findOrFail($id);

        return view('standard.detail', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('file')->store('news', 'public');

        return response()->json(['location' => asset('storage/' . $path)]);
    }
}
