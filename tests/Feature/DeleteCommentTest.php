<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Comment;
use App\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class DeleteCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        
        $this->signIn();

        
    }

    /** @test */
    public function a_user_can_delete_a_comment()
    {
        $this->withoutExceptionHandling();

        $comment = create(Comment::class, [
            'user_id' => auth()->user()->id
        ]);

        // dd(Comment::get());

        // $this->assertDatabaseHas('comments', (array) $comment);

        // $array_comment = (array) $comment;

        // dd($comment);
        // dd($array_comment);

        $this->delete("articles/comment-delete/{$comment->id}", (array) $comment);
        
        // dd(Comment::get());
        
        $this->assertDatabaseCount('comments', 0);
    }

    /** @test */
    public function a_user_can_delete_his_comment()
    {
        $user = create(User::class);

        $comment = create(Comment::class, [
            'user_id' => $user->id
        ]);

        $this->delete("articles/comment-delete/{$comment->id}", (array) $comment)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
