@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Нүүр хуудас</div>

                <div class="card-body">


                    @if(Auth::user()->type == 9)

                    <div class="row cards"><div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#A3FF33;border-color:#A3FF33" class="fa fa-map-marker text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Газрийн зурагаар харах</div>
                                        <div class="stat-digit"> <a href="{{url('home')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#E7FF33;border-color:#E7FF33" class="fa fa-shopping-cart text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Байгуулгууд</div>
                                        <div class="stat-digit"> {{$customers}}<a href="{{route('Customer.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#AFFF33;border-color:#AFFF33" class="fa fa-shopping-basket text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Хэрэглэгчид</div>
                                        <div class="stat-digit"> {{$users}} <a href="{{route('User.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#ffc107;border-color:#ffc107" class="fa fa-truck text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Нийт төхөөрөмжүүд</div>
                                        <div class="stat-digit"> {{$devices}} <a href="{{route('Device.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#3392FF;border-color:#3392FF" class="fa fa-check-square-o text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Идэвхитэй төхөөрөмжүүд</div>
                                        <div class="stat-digit"> {{$false_devices}} <a href="{{route('Device.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#28a745;border-color:#28a745" class="fa fa-check-circle text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Нэхэмжлэх</div>
                                        <div class="stat-digit"> {{$invoices}} <a href="{{route('Invoice.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                    @else
                    <div class="row cards"><div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#A3FF33;border-color:#A3FF33" class="fa fa-map-marker text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Газрийн зурагаар харах</div>
                                        <div class="stat-digit"> <a href="{{url('showDevices')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#AFFF33;border-color:#AFFF33" class="fa fa-shopping-basket text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Хэрэглэгчид</div>
                                        <div class="stat-digit"> {{$users}} <a href="{{route('User.index')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#ffc107;border-color:#ffc107" class="fa fa-truck text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Нийт төхөөрөмжүүд</div>
                                        <div class="stat-digit"> {{$devices}} <a href="{{url('listDevices')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">

                                    <div class="stat-icon dib"><i style="color:#28a745;border-color:#28a745" class="fa fa-check-circle text-default border-default"></i></div>

                                    <div class="stat-content dib">
                                        <div class="stat-text">Нэхэмжлэх</div>
                                        <div class="stat-digit"> {{$invoices}} <a href="{{url('ShowInvoices')}}" class="btn btn-xs btn-primary"> харах </a>    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
