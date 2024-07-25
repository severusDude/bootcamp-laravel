<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::with('category')->latest()->withTrashed()->paginate(5);

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
        $related = News::with('user', 'category', 'comments')
            ->where('category_id', $news->category_id)
            ->limit(4)
            ->get();

        return view('standard.detail', compact('news', 'related'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $news = News::findOrFail($id);
        $categories = Category::all();

        return view('admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $news->title = $request->title;
        $news->body = $request->body;
        $news->category_id = $request->category_id;

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $news = News::withTrashed()->findOrFail($id);
        $news->restore();

        return redirect()->route('admin.news.index')->with('success', 'News restored successfully');
    }

    public function store_comment(Request $request, string $id)
    {
        $request->validate(['content' => 'required']);

        $comment = new Comment;

        $comment->news_id = $id;
        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('news.show', $id);
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
