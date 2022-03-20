@extends('layouts.app')

@section('content')

<div class="container-fluid d-flex justify-content-center mt-3">
    <form action="{{route('email.verify', $userId)}}" method="POST">
        @csrf
        @include('flash-message')
        <div class="form-group">
            <label for="key">Please check your email and enter the verfication key.</label>
            <input class="form-control" type="text" name="key" id="key" required>
        </div>
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary">OK</button>
        </div>
    </form>
</div>
@endsection