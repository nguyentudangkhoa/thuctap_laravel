@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add a location</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('add-location-now')}}" method="POST">
        @if (count($errors)>0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}
                @endforeach
            </div>
            @endif
        @if(Session::has('Add-Location'))
                <div class="alert alert-success">{{Session::get('Add-Location')}}</div>
        @endif
        @if(Session::has('Fail-Add-Location'))
            <div class="alert alert-danger">{{Session::get('Fail-Add-Location')}}</div>
        @endif
        <input type="hidden" name="_token" value={{ csrf_token() }} >
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Location name</label>
          <input type="text" class="form-control" name="location_name" id="location_name" placeholder="Location name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Parent id</label>
          <input type="text" class="form-control" name="parent_id" id="parent id" placeholder="Parent id">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>
@endsection

