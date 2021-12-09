@extends('layout')

@section('title')
    Post create
@endsection

@section('content')
    <div class="container">
        <div class="col-3">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputTitle" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleInputTitle" aria-describedby="titleHelp">
                    @if ($errors->has('title'))
                        <div id="titleHelp" class="form-text text-danger">{{ $errors->first('title') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputContent" class="form-label">Content</label>
                    <textarea name="content" id="exampleInputContent" cols="30" rows="10" class="form-control" aria-describedby="contentHelp"></textarea>
                    @if ($errors->has('content'))
                        <div id="contentHelp" class="form-text text-danger">{{ $errors->first('content') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputImage" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputImage" aria-describedby="imageHelp">
                    @if ($errors->has('image'))
                        <div id="imageHelp" class="form-text text-danger">{{ $errors->first('image') }}</div>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('style')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.min.js" defer></script>
@endsection

@section('script')
@endsection
