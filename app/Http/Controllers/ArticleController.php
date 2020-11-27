<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{

    public function validateRequest()
    {
        return request()->validate([
            'title' => ['required'],
            'text' => ['required',],
        ]);
    }

    public function index()
    {
        $articles = Article::all();
        return ArticleResource::collection($articles);
    }

    public function show(Article $article){
        
        return new ArticleResource($article);
    }

    public function store(Request $request){
        $article = new Article();
        $article->user_id = $request->user_id;
        $article->title = $request->title;
        $article->text = $request->text;

        if($article->save()){
            return new ArticleResource($article);
        }
    }

    // public function create(){
    //     return view('article.create');
    // }

    public function update(Request $request, Article $article){
        $article->title = $request->title;
        $article->text = $request->text;

        if($article->save()){
            return new ArticleResource($article);
        }
    }

    // public function edit(Article $article){
    //     return view('article.edit', compact('article'));
    // }

    public function destroy(Article $article){
        $article->delete();
        return new ArticleResource($article);
    }
}
