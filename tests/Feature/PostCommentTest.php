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

        // given what we have an input of comment
        $comment = [
            'message' => 'My message',
            'user_id' => '1',
            'article_id' => '1'
        ];

        

        // when we hit /articles/1 endpoint
        $response = $this->post('/comments/create', $comment);
        
        // then we should see article in the database
        $this->assertDatabaseHas('comments', $comment);

    }
}
