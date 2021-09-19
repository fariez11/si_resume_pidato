@extends('layout.layout')

@section('menu')
		<li class="nav-item pcoded-menu-caption">
			<label>Navigation</label>
		</li>
		<li class="nav-item">
		    <a href="bupati" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
		</li>
        <li class="nav-item active">
		    <a href="#" class="nav-link"><span class="pcoded-micon"><i class="feather icon-bookmark"></i></span><span class="pcoded-mtext">Data Resume</span></a>
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
                            <h5 class="m-b-10">Data Resume</h5>
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
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th>Nama Acara</th>
                                    <th>Tanggal</th>
                                    <th>tempat</th>
                                    <th>Alamat</th>
                                    <th>resume</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sql as $data)
                                <tr>
                                    <td style="text-align: center;">{{$data->ACARA_ID}}</td>
                                    <td>{{$data->ACARA}}</td>
                                    <td><?= date('d M Y',strtotime($data->TGL));?></td>
                                    <td>{{$data->TEMPAT}}</td>
                                    <td>Desa {{$data->DESA}}, Kec.{{$data->NAMA_KEC}}</td>
                                    <td>
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#resume{{$data->ACARA_ID}}"><i class="feather icon-file-text"></i></a> 
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    @foreach($sql as $res)
        <div id="resume{{$res->ACARA_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Data Resume</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <?php
                        $id = $res->ACARA_ID;
                        $edit = DB::SELECT("select*from acara a, desa b, kecamatan c where a.ALAMAT = b.WIL_ID and b.KEC = c.KEC_ID and  a.ACARA_ID = '$id'");
                    ?>

                    @foreach($edit as $upd)
                        <form action="/resume:upd={{$upd->ACARA_ID}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4" style=" height: 350px;">
                                        <div class="form-group">
                                            <label style="font-weight: bold;">Nama Acara</label>
                                            <p>{{$upd->ACARA}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold;">Tanggal Acara</label>
                                            <p><?= date('d M Y',strtotime($data->TGL));?></p>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold;">Tempat Acara</label>
                                            <p>{{$upd->TEMPAT}}</p>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-weight: bold;">Alamat</label>
                                            <p>Desa {{$upd->DESA}}, Kec.{{$upd->NAMA_KEC}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label style="font-weight: bold;">Resume</label>
                                        <textarea class="form-control" name="res" style="height: 90%;margin-bottom:10px;resize: none;"> {{$upd->RESUME}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button  class="btn  btn-secondary" data-dismiss="modal"><i class="feather icon-x-circle"></i> Tutup</button>
                                <button  class="btn  btn-danger"><i class="feather icon-edit"></i> Ubah</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div> 
    @endforeach

      
@endsection