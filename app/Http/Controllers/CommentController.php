<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create_comment()
    {
        return;
    }

    public function edit_comment(
        string $category,
        string $news_id,
        string $comment_id
    ) {
        return;
    }

    public function delete_comment(
        string $category,
        string $news_id,
        string $comment_id
    ) {
        return;
    }
}
