@extends('layout.layout')

@section('menu')
		<li class="nav-item pcoded-menu-caption">
			<label>Navigation</label>
		</li>
		<li class="nav-item">
		    <a href="ajudan" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
		</li>
        <li class="nav-item active">
		    <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Data Acara</span></a>
		</li>
		<!-- <li class="nav-item pcoded-hasmenu">
		    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Page layouts</span></a>
		    <ul class="pcoded-submenu">
		        <li><a href="layout-vertical.html" target="_blank">Vertical</a></li>
		        <li><a href="layout-horizontal.html" target="_blank">Horizontal</a></li>
		    </ul>
		</li> -->
@endsection

<?php
    
    $gen = array('Laki-laki','Perempuan');

?>

@section('content')
		<div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Data Peserta</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="ajudan"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="dt_acara">Pilih Acara</a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Peserta </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                        <?php
                            $acara = DB::SELECT("select*from acara where ACARA_ID = '$ida'");
                        ?>

                        @foreach($acara as $ac)
                        <div class="row">
                            <div class="col-md-4">
                                <label  style="font-weight: bold;">Nama Acara</label>
                                <p>{{$ac->ACARA}}</p>
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: bold;">Tempat Acara</label>
                                <p>{{$ac->TEMPAT}}</p>
                            </div>
                            <div class="col-md-4">
                                <label style="font-weight: bold;">Tgl Acara</label>
                                <p><?= date('d M Y',strtotime($ac->TGL));?></p>
                            </div>
                        </div>
                        @endforeach

                <hr>
                </div>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th>Nama</th>
                                    <th>keresahan</th>
                                    <th>ide</th>
                                    <th>surveior</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sql as $data)
                                <tr>
                                    <td style="text-align: center;width: 20px;">{{$data->PES_ID}}</td>
                                    <td style="width: 30px;">{{$data->NAMA_PES}} ({{$data->USIA}} thn)</td>
                                    <td style="width: 100px;">{{$data->KERESAHAN}}</td>
                                    <td style="width: 100px;">{{$data->IDE}}</td>
                                    <td style="width: 100px;">{{$data->NAMA}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                    <form action="/add_resume" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-footer">
                            <label style="font-weight: bold;">Resume</label>
                            @foreach($acara as $aca)
                                <input type="hidden" name="ia" value="{{$aca->ACARA_ID}}">                            
                            <textarea class="form-control" name="res" style="margin-bottom: -15px;height: 400px;"> {{$aca->RESUME}}</textarea>
                            @endforeach
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/dt_acara" class="btn btn-secondary btn-block" style="margin-top: 30px;"><i class="feather icon-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger btn-block" style="margin-top: 30px;"><i class="feather icon-edit"></i> Ubah </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
@endsection