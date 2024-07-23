<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create_comment(Request $request)
    {
        $uri = explode("/", $request->getUri());

        $category_id = $uri[3];
        $news_id = $uri[4];

        $comment = new Comment;

        $comment->news_id = $news_id;
        $comment->content = $request->comment;
        $comment->save();

        return redirect('/');
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
