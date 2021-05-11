@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Байгууллага</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Нүүр хуудас</a></li>
                            <li><a href="#">Байгууллага</a></li>
                            <li class="active">Жагсаалт</li>
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
                                <strong><U>Жагсаалт</U></strong> Байгууллага
                            </div>
                            <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-9">

                                <form action="{{route('Customer.index')}}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <label for="exampleInputName2" class="pr-1  form-control-label">Хайлтын цонх</label>
                                        <input type="text" id="exampleInputName2" placeholder="Хайх утга" class="form-control" name="s" value="{{isset($s) ? $s : '' }}"></div>
                                </form>

                                </div>
                                <div class="col-md-3">
                                <a href="{{route('Customer.create')}}" class="btn btn-info btn-sm pull-right"> Нэмэх   </a>

                                </div>
                            </div>



                                <hr>
                                 <div class="table-stats order-table ov-h">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="serial">#</th>
                                            <th>ID</th>
                                            <th>Нэр</th>
                                            <th>Регистэр</th>
                                            <th>Утас</th>
                                            <th>Дансны дугаар</th>
                                            <th>Тохируулга</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $key => $customer)
                                        <tr>
                                            <td class="serial">{{$key+1 }}</td>
                                            <td>  <span class="name">{{$customer->id}}</span> </td>
                                            <td>  <span class="name"> <a href="{{route('Customer.show',$customer->id)}}" class="btn btn-info">{{$customer->name}}</a> </span> </td>
                                            <td>  <span class="name">{{$customer->re_number}}</span> </td>
                                            <td>
                                                <span class="name">{{$customer->phone}}</span>
                                            </td>
                                            <td>
                                                <span class="name">{{$customer->acount_number}}</span>
                                            </td>
                                            <td>   <a href="{{route('Customer.edit',$customer->id)}}" class="btn btn-warning"> Засах</a>
                                                   <a href="{{url('CustomerAddUser',$customer->id)}}" class="btn btn-primary"> Хэрэглэгч нэмэх</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->


                            </div>
                            <div class="card-footer">

                            {{ $customers->links() }}

                            </div>
                        </div>

        </div>

    </div>

 </div>


@endsection
