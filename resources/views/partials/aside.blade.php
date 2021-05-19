 <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="/"><i class="menu-icon fa fa-laptop"></i>Нүүр хуудас </a>
                    </li>

                    <li class="menu-title">Хэрэглэгчийн үйлдэл</li><!-- /.menu-title -->

                    @if(Auth::user()->type == 9)
                        <li>
                            <a href="{{route('User.index')}}"><i class="menu-icon fa fa-user"></i>Хэрэглэгчид</a>
                        </li>
                        <li>
                            <a href="{{route('Customer.index')}}"><i class="menu-icon fa fa-user"></i>Байгууллагууд</a>
                        </li>
                        <li>
                            <a href="{{route('Device.index')}}"><i class="menu-icon fa fa-map-marker"></i>Төхөөрөмжүүд</a>
                        </li>
                        <li>
                            <a href="{{url('/RawData')}}"><i class="menu-icon fa fa-map-marker"></i>Raw Data</a>
                        </li>

                    @else

                        <li>
                            <a href="{{url('listDevices')}}"><i class="menu-icon fa fa-map-marker"></i>Төхөөрөмжүүд</a>
                        </li>

                    @endif



                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
