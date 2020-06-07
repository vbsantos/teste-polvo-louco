@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-transparent text-dark">
        <div class="card-header d-flex justify-content-between">
            <h3 class="title">Dashboard</h3>
            <div class="ml-auto">
                <a href="/employees/create" class="btn btn-outline-primary">Register Employee</a>
                <a href="/companies/create" class="btn btn-outline-primary">Register Company</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel-body">
                <div class="accordion" id="companies">
                    @if(isset($companies) && count($companies) > 0)
                        @foreach ($companies as $company)
                            <div class="card bg-transparent text-dark">
                                <div class="card-header" id="headingOne">
                                    <button class="btn btn-link w-100" type="button" data-toggle="collapse" data-target="#company{{$company->id}}" aria-expanded="true" aria-controls="company{{$company->id}}">
                                        <div class="d-flex justify-content-between">
                                            @if($company->logo == "")
                                                <img class="rounded" width="30" src="{{asset('assets/no-img.png')}}" alt="no logo">
                                            @else
                                                <img class="rounded" width="30" src="{{asset('storage/'.$company->logo)}}" alt="company logo">
                                            @endif
                                            <h5 class="mb-0">
                                                {{$company->name}}
                                            </h5>
                                        <div>
                                            <span class="badge badge-primary badge-pill">{{count($company->employees)}}</span>
                                        </div>
                                    </div>
                                    </button>
                                </div>
                                <div id="company{{$company->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#companies">
                                    <div class="card-body">
                                        @if(count($company->employees) > 0)
                                            <table class="table table-bordered table-sm table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">E-mail</th>
                                                    <th scope="col">Phone Number</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($company->employees as $employee)
                                                        <tr style="cursor: pointer;" onclick="window.location='employees/{{$employee->id}}/edit';">
                                                            <th scope="row">{{$employee->id}}</th>
                                                            <td>{{$employee->firstname}}</td>
                                                            <td>{{$employee->lastname}}</td>
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
                        @endforeach
                    @else
                        <p>There are no companies registered</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
