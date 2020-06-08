@extends("layouts.app")
@section("title", "Update Company")
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
        <div id="form" class="card bg-transparent text-dark mx-auto">
            <div class="card-header text-center">
                <h3 class="title">Update Company</h3>
            </div>
            <form method="POST" action="{{route("company.update", ["id"=> $company->id])}}" enctype="multipart/form-data">
                {{ method_field("PUT") }}
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$company->name}}" placeholder="{{$company->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$company->email}}" placeholder="{{$company->email}}">
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
                        <input type="text" class="form-control" name="site" id="site" value="{{$company->site}}" placeholder="{{$company->site}}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{url()->previous()}}" class="btn btn-outline-primary">Cancel</a>
                        <a href="/companies/{{$company->id}}/delete" class="btn btn-outline-danger">Delete</a>
                        <button type="submit" class="btn btn-outline-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
