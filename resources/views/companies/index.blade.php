@extends('layouts.app')
@section('title', 'Companies')
@section('content_header')
@stop

@section('content')
<div class="container">
    <div class="card bg-transparent text-dark">
        <div class="card-header d-flex justify-content-between">
            <h3 class="title">Companies</h3>
            {{-- <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search by name" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
            <a href="/companies/create" class="btn btn-outline-primary w-25">Register Company</a>
        </div>
        <div class="card-body">
            @if(isset($companies) && count($companies) > 0)
                <table class="table table-bordered table-sm table-striped table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Homepage</th>
                        <th scope="col">Employees</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr style="cursor: pointer;" onclick="window.location='companies/{{$company->id}}/edit';">
                                <th scope="row">{{$company->id}}</th>
                                    @if($company->logo == "")
                                        <td><img class="img-thumbnail rounded" width="50" src="{{asset('assets/no-img.png')}}" alt="no logo"></td>
                                    @else
                                        <td><img class="img-thumbnail rounded" width="50" src="{{asset('storage/'.$company->logo)}}" alt="company logo"></td>
                                    @endif
                                <td>{{$company->name}}</td>
                                <td>{{$company->email}}</td>
                                <td><a href="{{$company->site}}">{{$company->site}}</a></td>
                                <td>{{count($company->employees)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>There are no companies registered</p>
            @endif
        </div>
    </div>
</div>
@endsection
