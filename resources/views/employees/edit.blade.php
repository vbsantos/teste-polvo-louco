@extends("layouts.app")
@section("title", "Update Employee")
@section("content_header")
@stop

@section("content")
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
                <h3 class="title">Update Employee</h3>
            </div>
            <form method="POST" action="{{route("employee.update", ["id"=> $employee->id])}}" enctype="multipart/form-data">
                {{ method_field("PUT") }}
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" name="firstname" class="form-control" id="firstname" value="{{$employee->firstname}}" placeholder="{{$employee->firstname}}">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" value="{{$employee->lastname}}" placeholder="{{$employee->lastname}}">
                    </div>
                    <div class="form-group">
                        <label>Select Company</label>
                        <select class="form-control" name="company_id">
                            @foreach($companies as $company)
                                @if($employee->company_id == $company->id)
                                    <option name='company_id' value="{{$company->id}}" selected>{{$company->name}}</option>
                                @else
                                    <option name='company_id' value="{{$company->id}}">{{$company->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$employee->email}}" placeholder="{{$employee->email}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{$employee->phone}}" placeholder="{{$employee->phone}}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{url()->previous()}}" class="btn btn-outline-primary">Cancel</a>
                        <a href="/employees/{{$employee->id}}/delete" class="btn btn-outline-danger">Delete</a>
                        <button type="submit" class="btn btn-outline-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
@endsection
