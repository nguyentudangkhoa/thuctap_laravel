@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">House Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','Name=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','Name=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','Id=asc')}}">Tăng theo ID</a></li>
                  <li><a href="{{route('simple','Id=desc')}}">Giảm theo ID</a></li>
                </ul>
                <form action="{{route('add-house')}}" method="get">
                    <button type="submit" class="btn btn-primary">Add a house</button>
                </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Details</th>
                    <th>Address</th>
                    <th>Location</th>
                    <th>Create at</th>
                    <th>Update at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($array as $value)
                  <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->house_name}}</td>
                    <td>{{$value->house_type}}</td>
                    <td>{{$value->house_details}}</td>
                    <td>{{$value->house_address}}</td>
                    <td>{{$value->location_name}}</td>
                    <td>{{$value->create_at}}</td>
                    <td>{{$value->update_at}}</td>
                    <td>
                        <form action="{{route('delete',$value->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                        <form action="{{route('House-edit',$value->id)}}" method="get">
                            <input type="submit" class="btn btn-info" value="Update">
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            <div class="row">{{$house_product->links()}}</div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Location Table</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','NameOfLocation=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','NameOfLocation=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','IdOfLocation=asc')}}">tăng theo ID</a></li>
                  <li><a href="{{route('simple','IdOfLocation=desc')}}">Giảm theo ID</a></li>
                </ul>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 100%;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>City</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($Location as $lo_item)
                  <tr>
                    <td>{{$lo_item->id}}</td>
                    <td>{{$lo_item->location_name}}</td>
                    @if ($lo_item->parent_id == 2)
                        <td>TP.Hồ Chí Minh</td>
                    @else
                        <td>Chưa có bảng parent</td>
                    @endif
                   </tr>
                @endforeach
                </tbody>
              </table>
              <div class="row">{{$Location->links()}}</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Table</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Sort
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="{{route('simple','NameOfUser=asc')}}">Tăng theo tên</a></li>
                  <li><a href="{{route('simple','NameOfUser=desc')}}">Giảm theo tên</a></li>
                  <li><a href="{{route('simple','IdOfUser=asc')}}">Tăng theo ID</a></li>
                  <li><a href="{{route('simple','IdOfUser=desc')}}">Giảm theo ID</a></li>
                </ul>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 100%;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create at</th>
                    <th>Update at</th>
                    <th>Log In at</th>
                    <th>Log Out at</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($User as $user_item)
                  <tr>
                    <td>{{$user_item->id}}</td>
                    <td>{{$user_item->name}}</td>
                    <td>{{$user_item->email}}</td>
                    <td>{{$user_item->created_at}}</td>
                    <td>{{$user_item->updated_at}}</td>
                    <td>{{$user_item->login_at}}</td>
                    <td>{{$user_item->logout_at}}</td>
                   </tr>
                @endforeach
                </tbody>
              </table>
              <div class="row">{{$User->links()}}</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
