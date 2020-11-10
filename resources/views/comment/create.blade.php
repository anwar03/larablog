@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">comment</div>

                    <div class="card-body">
                        <form method="POST" action="/comment">
                            @csrf

                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">Comment</label>

                                <div class="col-md-6">
                                    <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment" autofocus>

                                    @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="post_id" class="col-md-4 col-form-label text-md-right">post_id</label>

                                <div class="col-md-6">
                                    <input id="post_id" type="text" class="form-control @error('post_id') is-invalid @enderror" name="post_id" value="{{ old('post_id') }}" autocomplete="post_id" autofocus>
                                    
                                    @error('post_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
