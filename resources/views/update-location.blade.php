@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update location</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('make-update-location',$location->id)}}" method="POST">
        @method('PATCH')
        @csrf
        @if (count($errors)>0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{$err}}
                @endforeach
            </div>
            @endif
        @if(Session::has('Update-User'))
                <div class="alert alert-success">{{Session::get('Update-Location')}}</div>
        @endif
        @if(Session::has('Fail-Update-User'))
                <div class="alert alert-danger">{{Session::get('Fail-Update-Location')}}</div>
        @endif
        <input type="hidden" name="_token" value={{ csrf_token() }} >
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Location name</label>
          <input type="text" class="form-control" name="location_name" value="{{$location->location_name}}" id="location_name" placeholder=" Location">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Parent ID</label>
          <input type="text" class="form-control" name="parent_id" value="{{$location->parent_id}}" id="parent_id" placeholder="Parent id">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </form>
</div>
@endsection

