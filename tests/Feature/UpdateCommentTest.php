<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UpdateCommentTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function a_user_can_update_a_comment()
    {
        $this->withoutExceptionHandling();

        // given
        $comment = create(Comment::class, [
            'user_id' => auth()->user()->id,
        ]);

        $updated = [
            'message' => 'Updated message',
        ];

        // when
        $this->patch("/articles/comment-update/{$comment->id}", $updated);

        // then
        tap($comment->fresh(), function ($comment) {
            $this->assertEquals('Updated message', $comment->message);
        });

    }

    /** @test */
    public function user_can_only_update_his_comments()
    {
        $user = create(User::class);

        $comment = create(Comment::class, [
            'user_id' => $user->id
        ]);

        $updated = [
            'message' => 'Updated message'
        ];

        $this->patch("articles/comment/{$comment->id}", $updated)
            ->assertStatus(Response::HTTP_FORBIDDEN);

    }
}
