@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-offset-md-2">
                @if(Auth::user())
                <a href="/article/create" class="btn btn-outline-primary float-right mb-1">Post</a>
                @endif
            </div>
            <div class="col-md-8 col-offset-md-2">
               @foreach($posts as $post)
                  
                     <div class="card" style="margin-bottom: 14px;">
                        <div class="card-body">
                        <a href="/article/{{ $post->id }}">
                           <h5 class="card-title">{{ $post->title }}</h5>
                        </a>
                        <p class="card-text">{{ $post->text }}</p>
                        </div>
                     </div>
                  
               @endforeach
            </div>
         </div>
      </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <form id="del_rules"  method="POST" >
            @csrf
            @method('DELETE')
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure deleted this Transaction??
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <div type="submit" class="btn btn-outline-danger">Confirm</div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script>
        function base_url() {
            return 'http://127.0.0.1:8000/';
        }

        function delete_transaction(id){
            let url = base_url() +'article/'+id;
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(result) {
                    window.location.reload()
                }
            });
        }
    </script>

@endsection

