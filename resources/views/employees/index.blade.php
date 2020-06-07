@extends('layouts.app')
@section('title', 'Employees')
@section('content_header')
@stop

@section('content')
    <div class="container">
        <div class="card bg-transparent text-dark">
            <div class="card-header d-flex justify-content-between">
                <h3 class="title">Employees</h3>
                {{-- <form class="form-inline" method="GET" action="{{route("employee.index")}}">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> --}}
                <a href="/employees/create" class="btn btn-outline-primary w-25">Register Employee</a>
            </div>
            <div class="card-body">
                @if(isset($employees) && count($employees) > 0)
                    <table class="table table-bordered table-sm table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr style="cursor: pointer;" onclick="window.location='employees/{{$employee->id}}/edit';">
                                    <th scope="row">{{$employee->id}}</th>
                                    <td>{{$employee->firstname}}</td>
                                    <td>{{$employee->lastname}}</td>
                                    <td>{{$employee->company->name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>There are no employees registered</p>
                @endif
            </div>
        </div>
    </div>
@endsection
