<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Comment;
use Illuminate\Support\Facades\Session;

class DeleteCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        
        $this->signIn();

        Session::start(); // starts session, this is what handles csrf token part
        
    }

    /** @test */
    public function a_user_can_delete_a_comment()
    {
        $this->withoutExceptionHandling();

        $comment = create(Comment::class, [
            'user_id' => auth()->user()->id
        ]);

        // $this->assertDatabaseHas('comments', (array) $comment);

        // $array_comment = (array) $comment;

        // dd($comment);
        // dd($array_comment);

        $this->delete("articles/comment-delete/{$comment->id}", (array) $comment);
        
        $this->assertDatabaseHas('comments', (array) $comment);

    }
}
