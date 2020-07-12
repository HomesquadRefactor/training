<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Mail\EmailCommentToAuthor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(CommentRequest $request) 
    {
        $comment = Comment::create([
            'message' => $request->message,
            'user_id' => $request->user_id,
            'article_id' => $request->article_id
        ]);

        $article = Article::with('author')->where('id', $request->article_id)->first();
        // dd($article);
        $author = User::where('id', $article->author->id)->first();
        // dd($author);

        Mail::to($author->email)->send(new EmailCommentToAuthor());

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
