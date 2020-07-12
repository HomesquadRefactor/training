<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request) 
    {
        $comment = Comment::create([
            'message' => $request->message,
            'user_id' => $request->user_id,
            'article_id' => $request->article_id
        ]);

        return redirect()->to('/articles');
    }

    public function update(Comment $comment) 
    {

        $this->authorize('update', $comment);

        $comment->update(request()->all());

        return redirect()->to('/articles');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->to('/articles');
    }
}
