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
		            <div class="form-group"><label for="company" class=" form-control-label">Нэр</label><input type="text" id="company" name="name" class="form-control"></div>
                    <div class="form-group"><label for="company" class=" form-control-label">Imei</label><input type="text" id="company" name="imei" class="form-control"></div>

		           
		            

		                <input type="submit" name="" value="Оруулах" class="btn btn-success">
		               </form>

		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
 
@endsection
