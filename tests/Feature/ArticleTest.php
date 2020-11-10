<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private function article($data = [])
    {
        return array_merge([
            'title' => $this->faker->name(),
            'text' => $this->faker->text(),
        ], $data);
    }

    /** @test */
    public function only_signed_in_users_can_be_created()
    {
        $this->withExceptionHandling();

        $this->post('/article', $this->article())
            ->assertRedirect('/login');
        
        $this->assertCount(0, Article::all());
    }

    /** @test */
    public function article_can_be_created()
    {
        $this->login_user();

        $data = $this->article();

        // $response = $this->call('POST', '/article', $data);
        $response = $this->post('/article', $data);
        $response->assertRedirect('/');

        $article = Article::first();

        $this->assertCount(1, Article::all());

        $this->assertEquals($data['title'], $article['title']);
        $this->assertEquals($data['text'], $article['text']);
    }

    /** @test */
    public function article_can_be_updated()
    {
        $this->login_user();

        $this->post('/article', $this->article());

        $article = Article::first();
        $this->assertCount(1, Article::all());

        $data = $this->article([
            "title" => "Update title",
            'text' => "update type",
        ]);

        $update = $this->patch($article->path(), $data);

        $article = Article::first();

        $this->assertEquals($data['title'], $article->title);
        $this->assertEquals($data['text'], $article->text);
        $update->assertRedirect('/');
    }

    /** @test */
    public function article_can_be_deleted()
    {
        $this->login_user();


        $data = $this->article();
        $insert = $this->post('/article', $data);

        $transaction = Article::first();

        $this->assertCount(1, Article::all());
        $insert->assertRedirect('/');

        $delete = $this->delete($transaction->path());

        $this->assertCount(0, Article::all());
        $delete->assertRedirect('/');
    }

    /** @test */
    public function article_can_be_viewed()
    {
        $this->login_user();

        $data = $this->article();

        $this->post('/article', $data);

        $article = Article::first();

        $get = $this->get($article->path());

        $get->assertSee($data['title']);
        $get->assertSee($data['text']);
    }


    /** @test */
    public function all_user_article_can_be_viewed()
    {
        $this->login_user();

        $data = $this->article();

        $this->post('/article', $data);

        $article = Article::first();

        $get = $this->get($article->path());

        Auth::logout();

        $get->assertSee($data['title']);
        $get->assertSee($data['text']);
    }

    /** @test */
    public function article_required_fields_should_be_filled()
    {
        $this->login_user();

        $data = $this->article([
            "title" => "",
            "text" => "",
        ]);

        $insert = $this->post('/article', $data);

        $insert->assertSessionHasErrors('title');
        $insert->assertSessionHasErrors('text');
    }

    public function login_user(){
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        return $this;
    }
}
