@extends('layout')

@section('title')
    post list
@endsection

@section('header')
    <div class="container mb-5 pt-4">
        <div class="d-flex justify-content-between align-item-center">
            <div>{{ auth()->user()->name }}</div>
            <a href="{{ url('logout') }}" class="btn btn-warning" id="logout">Logout!</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="col">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $i => $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>
                            <img src="{{ $post->thumbnail }}" alt="thumb">
                        </td>
                        <td>
                            @if(auth()->id() % 2 == 0)
                                <button class="btn btn-success table-edit" data-id="{{ $post->id }}">Edit</button>
                                <button class="btn btn-success table-delete" data-id="{{ $post->id }}">Delete</button>
                            @endif
                            <button class="btn btn-success table-show" data-id="{{ $post->id }}">Show</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="modal-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal create</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="hidden" class="form-control" id="input-modal-edit-id">
                        <input type="text" class="form-control" id="input-modal-edit-title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" id="input-modal-edit-content" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save-modal-edit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="modal-show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal show</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title:</label>
                        <div id="input-modal-show-title"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content:</label>
                        <div id="input-modal-show-content"></div>
                    </div>
                    <div class="mb-3">
                        <img src="" id="input-modal-show-img">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="hidden" class="form-control" id="input-modal-edit-id">
                        <input type="text" class="form-control" id="input-modal-edit-title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea class="form-control" id="input-modal-edit-content" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save-modal-edit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.table-show', function(){
                let id = $(this).data('id');

                // show post
                $.ajax({
                    url: 'post/' + id,
                    method: 'get',
                    dataType: 'json',
                    data:{
                        _token: '{{ @csrf_token() }}',
                    },
                    beforeSend: function(){},
                    complete: function(){},
                    success: function(json){
                        $('#modal-show').modal('show');

                        $('#input-modal-show-title').text(json.title);
                        $('#input-modal-show-content').text(json.content);
                        $('#input-modal-show-img').prop('src', json.thumbnail);
                    },
                });
            });

            $(document).on('click', '.table-edit', function(){
                let id = $(this).data('id');

                // show edit post
                $.ajax({
                    url: 'post/' + id + '/edit',
                    method: 'get',
                    dataType: 'json',
                    data:{
                        _token: '{{ @csrf_token() }}',
                    },
                    beforeSend: function(){},
                    complete: function(){},
                    success: function(json){
                        $('#modal-edit').modal('show');

                        $('#input-modal-edit-id').val(json.id);
                        $('#input-modal-edit-title').val(json.title);
                        $('#input-modal-edit-content').val(json.content);
                    },
                });
            });

            $(document).on('click', '#btn-save-modal-edit', function(){
                let id = $('#input-modal-edit-id').val();
                let title = $('#input-modal-edit-title').val();
                let content = $('#input-modal-edit-content').val();

                // show edit post
                $.ajax({
                    url: 'post/' + id,
                    method: 'post',
                    dataType: 'json',
                    data:{
                        _token: '{{ @csrf_token() }}',
                        _method: 'PUT',
                        title: title,
                        content: content,
                    },
                    beforeSend: function(){},
                    complete: function(){},
                    success: function(json){
                        alert(json.message);

                        window.location.reload();
                    },
                });
            });

            // delete post
            $(document).on('click', '.table-delete', function(){
                let id = $(this).data('id');

                if (confirm("are you sure to delete the post?")) {
                    // remove post
                    $.ajax({
                        url: 'post/' + id,
                        method: 'post',
                        dataType: 'json',
                        data:{
                            _token: '{{ @csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(json){
                            alert(json.message);

                            window.location.reload();
                        },
                    });
                }
            });
        });
    </script>
@endsection
