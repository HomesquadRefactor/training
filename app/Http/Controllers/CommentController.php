<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(CommentRequest $request)
    {
        $comment = Comment::create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'article_id' => $request->article_id,
        ]);

        return redirect()->route('articles.show', $comment);
    }
}
