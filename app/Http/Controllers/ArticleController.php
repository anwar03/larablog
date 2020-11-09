<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function validateRequest()
    {
        return request()->validate([
            'title' => ['required'],
            'text' => ['required',],
        ]);
    }

    public function store(){
        auth()->user()->articles()->create($this->validateRequest());
        return redirect('/');
    }

    public function create(){
        return view('article.create');
    }

    public function update(Article $article){
        $article->update($this->validateRequest());
        return redirect('/');
    }

    public function edit(Article $article){
        return view('article.edit', compact('article'));
    }

    public function destroy(Article $article){
        $article->delete();
        return redirect('/');
    }
}
