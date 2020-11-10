<?php

namespace Tests\Feature;

use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function data($data = [])
    {
        return array_merge([
            'comment' => $this->faker->text(),
            'post_id' => $this->faker->numberBetween(),
        ], $data);
    }

    /** @test */
    public function only_signed_in_users_can_be_created()
    {
        $this->withExceptionHandling();

        $this->post('/comment', $this->data())
            ->assertRedirect('/login');
        
        $this->assertCount(0, Comments::all());
    }

    /** @test */
    public function comment_can_be_created()
    {
        $this->login_user();

        $data = $this->data();

        $response = $this->post('/comment', $data);

        $comment = Comments::first();

        $this->assertCount(1, Comments::all());

        $this->assertEquals($data['comment'], $comment['comment']);
        $this->assertEquals($data['post_id'], $comment['post_id']);
    }

    /** @test */
    public function comment_can_be_updated()
    {
        $this->login_user();

        $this->post('/comment', $this->data());

        $comment = Comments::first();
        $this->assertCount(1, Comments::all());

        $data = $this->data([
            "comment" => $this->faker->text()
        ]);

        $update = $this->patch($comment->path(), $data);

        $comment = Comments::first();

        $this->assertEquals($data['comment'], $comment->comment);
        $this->assertEquals($data['post_id'], $comment->post_id);
        $update->assertRedirect('/');
    }

    /** @test */
    public function comment_can_be_deleted()
    {
        $this->login_user();

        $data = $this->data();
        $insert = $this->post('/comment', $data);

        $comment = Comments::first();

        $this->assertCount(1, Comments::all());

        $delete = $this->delete($comment->path());

        $this->assertCount(0, Comments::all());
    }

    /** @test */
    public function comment_can_be_viewed()
    {
        $this->login_user();

        $data = $this->data();

        $this->post('/comment', $data);

        $comment = Comments::first();

        $get = $this->get($comment->path());

        $get->assertSee($data['comment']);
        $get->assertSee($data['post_id']);
    }


    /** @test */
    public function all_user_article_can_be_viewed()
    {
        $this->login_user();

        $data = $this->data();

        $this->post('/comment', $data);

        $comment = Comments::first();

        $get = $this->get($comment->path());

        Auth::logout();

        $get->assertSee($data['comment']);
        $get->assertSee($data['post_id']);
    }

    /** @test */
    public function article_required_fields_should_be_filled()
    {
        $this->login_user();

        $data = $this->data([
            "comment" => "",
            "post_id" => "",
        ]);

        $insert = $this->post('/comment', $data);

        $insert->assertSessionHasErrors('comment');
        $insert->assertSessionHasErrors('post_id');
    }

    public function login_user(){
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        return $this;
    }
}
