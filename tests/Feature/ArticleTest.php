<?php

namespace Tests\Feature;

use App\Models\Article;
use App\User;
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
            'user_id' => $this->faker->numberBetween(),
        ], $data);
    }

    /** @test */
    public function article_can_be_created()
    {
        $this->withExceptionHandling();
        $data = $this->article();

        $this->post('/article', $data);

        $article = Article::first();

        $this->assertCount(1, Article::all());

        $this->assertEquals($data['title'], $article['title']);
        $this->assertEquals($data['text'], $article['text']);

    }
}
