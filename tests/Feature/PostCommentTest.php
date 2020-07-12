<?php

namespace Tests\Feature;

use App\Article;
use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->signIn();
    }

    /** @test */
    public function a_user_can_post_a_comment_on_an_article()
    {
        $this->withoutExceptionHandling();

        // given
        // $comment = [
        //     'message' => 'Hello',
        //     'user_id' => '1',
        //     'article_id' => '1'
        // ];

        // author of the article
        $user = create(User::class);

        // the article 
        $article = create(Article::class, [
            'user_id' => $user->id
        ]);

        $comment = raw(Comment::class, [
            'user_id' => auth()->user()->id,
            'article_id' => $article->id
        ]);

        // when
        $response = $this->post('/articles/comment', $comment);

        // then
        $this->assertDatabaseHas('comments', $comment);
    }
}
