<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comments;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $posts = Article::all();
        return view('article.index', compact('posts'));
    }

    public function show(Article $article){
        // var_dump($article->id);
        $comments = Comments::where('post_id', $article->id)->get();;
        // dd($comments);
        return view('article.show', compact('article', 'comments'));
    }
}
