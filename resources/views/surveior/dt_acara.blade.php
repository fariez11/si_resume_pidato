@extends('layout.layout')

@section('menu')
		<li class="nav-item pcoded-menu-caption">
			<label>Navigation</label>
		</li>
		<li class="nav-item">
		    <a href="surveior" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
		</li>
        <li class="nav-item active">
		    <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Data Peserta</span></a>
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
		<div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Acara</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ajudan"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Pilih Acara</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Tabel Acara</h5> -->
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Acara</th>
                                    <th>Tanggal</th>
                                    <th>Tempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sql as $data)
                                <tr>
                                    <td style="text-align: center;">{{$data->ACARA_ID}}</td>
                                    <td>{{$data->ACARA}}</td>
                                    <td><?= date('d M Y',strtotime($data->TGL));?></td>
                                    <td>{{$data->TEMPAT}}</td>
                                    <td>
                                        <a href="/acara:pes={{$data->ACARA_ID}}" class="btn btn-info"><i class="feather icon-users"></i></a> 
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

       
@endsection