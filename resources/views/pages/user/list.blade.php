@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>User</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Users</a></li>
                            <li class="active">Lists</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="content">

 	 <div class="row">

        <div class="col-md-12">
                
                 <div class="card">
                            <div class="card-header">
                                <strong><U>Search</U></strong> User
                            </div>
                            <div class="card-body card-block">
                                <form action="{{url('showcustomers')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Search Box</label>
                                        <input type="text" id="exampleInputName2" placeholder="Search here" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Search
                                </button>
                            </div>
                        </div>

                 <div class="card">
                            <div class="card-header">
                                <strong><U>List</U></strong> User
                            </div>
                            <div class="card-body card-block">
                                 <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th class="avatar">Avatar</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Product</th>
                                            <th>Contack Numbers</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($users as $key =>$user)
                                        <tr>
                                            <td class="serial">{{$key+1}}</td>
                                            <td class="avatar">
                                                <div class="round-img">
                                                    <a href="#"><img class="rounded-circle" src="images/avatar/1.jpg" alt=""></a>
                                                </div>
                                            </td>
                                            <td> {{$user->id}} </td>
                                            <td> <span class="name">{{$user->name}}</span> </td>
                                            <td> <span class="product">{{$user->email}}</span> </td>
                                            <td> <span class="count">{{$user->contrackcount()}}}</span></td>
                                            <td>
                                                <span class="badge badge-complete">Complete</span>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">


                            </div>
                        </div>

        </div>

    </div>

 </div>


@endsection