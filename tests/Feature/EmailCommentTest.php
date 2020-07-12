<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

use App\Comment;
use App\Mail\EmailCommentToAuthor;
use App\User;

class EmailCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function a_comment_email_notification_has_been_sent()
    {

        $this->withoutExceptionHandling();

        Mail::fake();

        // author of the article
        $user = create(User::class);

        // the article 
        $article = create(Article::class, [
            'user_id' => $user->id
        ]);

        // dd(Article::get());

        // comment of the logged in user
        $comment = raw(Comment::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);

        $response = $this->post("/articles/comment", $comment);
        
        // dd(Comment::get());
        Mail::assertSent(EmailCommentToAuthor::class);

        // check if email was sent to the author of an article
        Mail::assertSent(EmailCommentToAuthor::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

}
