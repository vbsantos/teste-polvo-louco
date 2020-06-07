@extends('layouts.app')
@section('title', 'Register Company')
@section('content_header')
@stop

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card bg-transparent text-dark w-50 mx-auto">
            <div class="card-header text-center">
                <h3>Register Company</h3>
            </div>
            <form method="POST" action="{{action('CompaniesController@store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Company Name">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="company@example.com">
                    </div>
                    <div class="form-group">
                        <label for="logo">Company Logo:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input" id="logo">
                                <label class="custom-file-label" for="logo">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="site">Homepage:</label>
                        <input type="text" class="form-control" name="site" id="site" placeholder="http://www.company.com">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{url()->previous()}}" class="btn btn-outline-primary">Cancel</a>
                        <button type="submit" class="btn btn-outline-success">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
