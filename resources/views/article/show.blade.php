@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <div class="card" style="margin-bottom: 15px;">

                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->text }}</p>
                        @if(Auth::user() && Auth::user()->id == $article->user_id)
                        <a href="/article/{{ $article->id }}/edit" class="btn btn-outline-primary">Edit</a>
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        @endif
                    </div>
                </div> --}}

                <div id="comments">
                    <div class="container">
                        <Comments :userId="{{ Auth::user() ? Auth::user()->id : 0 }}"></Comments>
                        {{-- <Comments :userId="{{  Auth::user()->id }}"></Comments> --}}
                    </div>
                </div>
                
            </div>
        </div>
    </div>

@endsection

