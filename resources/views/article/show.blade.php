@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 15px;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->text }}</p>
                        @if(Auth::user() && Auth::user()->id == $article->user_id)
                        <a href="/article/{{ $article->id }}/edit" class="btn btn-outline-primary">Edit</a>
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        @endif
                    </div>
                </div>

                  
                <div class="card" style="margin-bottom: 14px;">
                    <div class="card-body" id="comment-body">
                        <h5 class="card-title">Comments</h5>
                        <form method="POST" action="/comment">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment" autofocus>
                                    </textarea>
                                    <input id="post_id" type="hidden" name="post_id" value="{{ $article->id }}" autocomplete="post_id" autofocus>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-right" id="button">
                                        Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                        @foreach($comments as $comment)
                        <div style="margin: 5px 0;">
                            <p class="card-text" style="padding: 10px; background-color: #fafafa;border-radius: 5px;">{{ $comment->comment }}
                            
                            </p>
                        </div>
                        @endforeach    
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <form method="POST" action="/article/{{ $article->id }}">
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">{{ $article->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure deleted this Article??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-danger">Confirm</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

