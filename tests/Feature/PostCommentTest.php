<?php

namespace Tests\Feature;

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
        $comment = [
            'message' => 'Hello',
            'user_id' => '1',
            'article_id' => '1'
        ];

        // when
        $response = $this->post('/articles/comment', $comment);

        // then
        $this->assertDatabaseHas('comments', $comment);
    }
}
