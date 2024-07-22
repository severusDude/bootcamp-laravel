<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function read_news(
        string $category,
        string $news_id
    ) {
        return "this is news";
    }

    public function create_news()
    {
        return "this is create news page";
    }

    public function update_news(
        string $category,
        string $news_id
    ) {
        return "this is update news page";
    }

    public function delete_news(
        string $category,
        string $news_id
    ) {
        return "this is delete news page";
    }
}
