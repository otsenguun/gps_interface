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
                            <li class="active">Бүртгэх</li>
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

		        <div class="card-header"><strong>Засах</strong><small> Байгууллага</small></div>
		        <div class="card-body card-block">
		        	<form action="{{route('Customer.update',$customer->id)}}" method="post" enctype="multipart/form-data">
		        		@csrf
                        {{ method_field('PUT') }}
		                    <div class="form-group"><label for="company" class=" form-control-label">Нэр</label><input type="text" id="company" name="name" class="form-control" value="{{$customer->name}}"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Регистэр</label><input type="text" id="company" name="re_number" class="form-control" value="{{$customer->re_number}}"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Утас</label><input type="text" id="company" name="phone" class="form-control" value="{{$customer->phone}}"></div>
                            <div class="form-group"><label for="company" class=" form-control-label">Дансний дугаар</label><input type="text" id="company" name="acount_number" class="form-control" value="{{$customer->acount_number}}"></div>

                            <input type="submit" name="" value="Хадгалах" class="btn btn-success">

		               </form>

		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>

@endsection
