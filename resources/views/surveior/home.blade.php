@extends('layout.layout')

@section('menu')
		<li class="nav-item pcoded-menu-caption">
			<label>Navigation</label>
		</li>
		<li class="nav-item active">
		    <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
		</li><li class="nav-item">
		    <a href="sdt_acara" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Data Peserta</span></a>
		</li>
		<!-- <li class="nav-item pcoded-hasmenu">
		    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
		    <ul class="pcoded-submenu">
		        <li><a href="layout-vertical.html" target="_blank">Vertical</a></li>
		        <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
		    </ul>
		</li> -->
@endsection

@section('content')
		<div class="row">
            <!-- order-card start -->
                        <div class="col-md-6 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-body">
                        <h6 class="text-white tulisan">Jumlah Acara</h6>
                        @foreach($ac as $ac)
                            <h2 class="text-right text-white"><i class="feather icon-shopping-cart float-left ikon"></i><span>{{$ac->ac}}</span></h2>
                        @endforeach
                        <!-- <p class="m-b-0">Completed Orders<span class="float-right">351</span></p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-body">
                        <h6 class="text-white tulisan">Jumlah Responden</h6>
                        @foreach($re as $re)
                            <h2 class="text-right text-white"><i class="feather icon-users float-left ikon"></i><span>{{$re->re}}</span></h2>
                        @endforeach
                        <!-- <p class="m-b-0">Completed Orders<span class="float-right">351</span></p> -->
                    </div>
                </div>
            </div>  
         </div>
@endsection