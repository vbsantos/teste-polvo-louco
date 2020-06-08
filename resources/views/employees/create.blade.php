@extends('layouts.app')
@section('title', 'Register Employee')
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
        <div id="form" class="card bg-transparent text-dark mx-auto">
            <div class="card-header text-center">
                <h3>Register Employee</h3>
            </div>
            <form method="POST" action="{{action('EmployeesController@store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Employee first name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Employee last name">
                    </div>
                    <div class="form-group">
                        <label>Select Company</label>
                        <select class="form-control" name="company_id">
                            @if (isset($companies) && count($companies) > 0)
                                @foreach($companies as $company)
                                <option name='company_id' value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Employee e-mail">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" name="phone" id="phone" placeholder="55999999999">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{url()->previous()}}" class="btn btn-outline-primary">Cancel</a>
                        <button type="submit" class="btn btn-outline-success">Register</button>
                    </div>
                </div>
            </form>
        </div>
@endsection
