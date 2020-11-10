<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;


class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateRequest()
    {
        return request()->validate([
            'comment' => ['required'],
            'post_id' => ['required',],
        ]);
    }

    public function store(){
        auth()->user()->comments()->create($this->validateRequest());
        return redirect('/');
    }

    public function create(){
        return view('comment.create');
    }

    public function update(Comments $comment){
        $comment->update($this->validateRequest());
        return redirect('/');
    }

    public function edit(Comments $comment){
        return view('comment.edit', compact('comment'));
    }

    public function destroy(Comments $comment){
        $comment->delete();
        return redirect('/');
    }
}
