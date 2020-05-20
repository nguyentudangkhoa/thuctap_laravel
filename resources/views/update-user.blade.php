@extends('layouts.admin')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update user</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{route('make-user-update',$user->id)}}" method="POST">
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
                <div class="alert alert-success">{{Session::get('Update-User')}}</div>
        @endif
        @if(Session::has('Fail-Update-User'))
                <div class="alert alert-danger">{{Session::get('Fail-Update-User')}}</div>
        @endif
        <input type="hidden" name="_token" value={{ csrf_token() }} >
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">User name</label>
          <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder=" user name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Email</label>
          <input type="text" class="form-control" name="email" value="{{$user->email}}" id="email" placeholder="email">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>

    </form>
</div>
@endsection

