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
                            <li class="breadcrumb-item"><a href="#!">Data Acara</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Tabel Acara</h5> -->
                    <button type="button" class="btn  btn-danger" data-toggle="modal" data-target="#exampleModalLive"><i class="feather icon-plus-circle"> </i>Tambah Acara</button>
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
                                    <th>Alamat</th>
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
                                    <td>Desa {{$data->DESA}}, Kec.{{$data->NAMA_KEC}}</td>
                                    <td>
                                        <a href="/peserta:data={{$data->ACARA_ID}}" class="btn btn-info"><i class="feather icon-file-text"></i></a> 
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editacara{{$data->ACARA_ID}}"><i class="feather icon-edit"></i></a> 
                                        <a href="/acara:del={{$data->ACARA_ID}}" class="btn btn-secondary" onclick="return(confirm('Anda Yakin ?'));"><i class="feather icon-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{url('/add_acara')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                    <div class="modal-body">
                        <div class="col-md-12">
                                
                                    @foreach($ida as $id)
                                        <input type="hidden" name="ida" class="form-control" value="{{$id->ACARA_ID+1}}" readonly="">
                                    @endforeach
                                    <div class="form-group">
                                        <label>Nama Acara</label>
                                        <input type="text" name="nama" class="form-control" placeholder="nama" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Acara</label>
                                        <input type="date" name="tgl" class="form-control" placeholder="Text">
                                    </div>
                                    <div class="form-group">
                                        <label>Tempat Acara</label>
                                        <input type="text" name="tempat" class="form-control" placeholder="tempat" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <select name="alamat" class="form-control"style="width: 100%;height: 50%;">
                                            <option></option>
                                            @foreach($dkc as $dk)
                                                <option value="{{$dk->WIL_ID}}">Desa {{$dk->DESA}}, Kec.{{$dk->NAMA_KEC}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn  btn-secondary" data-dismiss="modal"><i class="feather icon-x-circle"></i> Batal</button>
                        <button class="btn  btn-danger"><i class="feather icon-check-circle"></i> Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div> 

        @foreach($sql as $edit) 
        <div id="editacara{{$edit->ACARA_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Edit Acara</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                        <?php

                            $id = $edit->ACARA_ID;
                            $ed = DB::SELECT("select*from acara where ACARA_ID = '$id'");

                        ?>
                        @foreach($ed as $upd)
                        <form action="/acara:upd={{$upd->ACARA_ID}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="col-md-12">
                                    
                                            <input type="hidden" name="ida" class="form-control" value="{{$upd->ACARA_ID}}" readonly="">
                                        <div class="form-group">
                                            <label>Nama Acara</label>
                                            <input type="text" name="nama" class="form-control" value="{{$upd->ACARA}}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Acara</label>
                                            <input type="date" name="tgl" class="form-control" value="{{$upd->TGL}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tempat Acara</label>
                                            <input type="text" name="tempat" class="form-control" value="{{$upd->TEMPAT}}" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                        <label>Alamat</label>
                                        <select name="alamat" class="form-control"style="width: 100%;height: 50%;" required="">
                                            <option></option>
                                            @foreach($dkc as $dk)
                                               <?php if ($dk->WIL_ID == $upd->ALAMAT){ ?>
                                                   <option value="{{$dk->WIL_ID}}" selected="">Desa {{$dk->DESA}}, Kec.{{$dk->NAMA_KEC}}</option>
                                                <?php }else{ ?>
                                                  <option value="{{$dk->WIL_ID}}">Desa {{$dk->DESA}}, Kec.{{$dk->NAMA_KEC}}</option>
                                                <?php }?>
                                             @endforeach
                                        </select>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button  class="btn  btn-secondary" data-dismiss="modal"><i class="feather icon-x-circle"></i> Batal</button>
                            <button class="btn  btn-danger"><i class="feather icon-edit"></i> Ubah</button>
                        </div>
                        </form>
                        @endforeach
                </div>
            </div>
        </div>
        @endforeach
@endsection