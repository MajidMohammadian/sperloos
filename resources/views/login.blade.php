@extends('layout')

@section('title')
    login
@endsection

@section('content')
    <div class="container">
        <div class="col-3">
            <form action="{{ url('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @if ($errors->has('email'))
                        <div id="emailHelp" class="form-text text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
