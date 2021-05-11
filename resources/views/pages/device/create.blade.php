@extends('layouts.app')

@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Төхөөрөмж</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Төхөөрөмж</a></li>
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

		        <div class="card-header"><strong>Шинэ</strong><small> Төхөөрөмж</small></div>
		        <div class="card-body card-block">
		        	<form action="{{route('Device.store')}}" method="post" enctype="multipart/form-data">
		        		@csrf

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Нэр</label>
                            <input type="text" id="company" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Imei</label>
                            <input type="text" id="company" name="imei" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Утасны дугаар</label>
                            <input type="text" id="company" name="phone" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Пин код</label>
                            <input type="text" id="company" name="pin_code" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Байгууллага</label>
                            <select name="org_id" id="" class="form-control">
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}"> {{$customer->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Жолоочийн тухай</label>
                            <input type="text" id="company" name="driver_name" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Утасны апп холбох код</label>
                            <input type="text" id="company" name="app_driver" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company" class=" form-control-label">Төлөв</label>
                            <select name="status" id=""class="form-control">
                                    <option value="0">Идэвхитэй</option>
                                    <option value="1">Идэвхигүй</option>
                            </select>
                        </div>


                    </div>



		                <input type="submit" name="" value="Оруулах" class="btn btn-success">
		               </form>

		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>

@endsection
