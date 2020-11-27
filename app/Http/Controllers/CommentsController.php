<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;
use App\Models\Comments;


class CommentsController extends Controller
{

    public function index()
    {
        $comment = Comments::all();
        return CommentResource::collection($comment);
    }

    public function show(Comments $comment){
        
        return new CommentResource($comment);
    }

    public function store(Request $request){
        $comment = new Comments();
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        if($comment->save()){
            return new CommentResource($comment);
        }
    }

    // public function create(){
    //     return view('article.create');
    // }

    public function update(Request $request, Comments $comment){
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        if($comment->save()){
            return new CommentResource($comment);
        }
    }

    // public function edit(Article $article){
    //     return view('article.edit', compact('article'));
    // }

    public function destroy(Comments $comment){
        $comment->delete();
        return new CommentResource($comment);
    }
}
