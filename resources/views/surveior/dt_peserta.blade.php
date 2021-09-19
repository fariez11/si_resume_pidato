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

<?php
    
    $gen = array('Laki-laki','Perempuan');

    $pen = array('SD','SMP','SMA/Sederajat','D3','S1','S2','S3');

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
                            <li class="breadcrumb-item"><a href="sdt_acara">Pilih Acara</a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Peserta </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h5>Tabel Acara</h5> -->
                    <button type="button" class="btn  btn-danger" data-toggle="modal" data-target="#exampleModalLive"><i class="feather icon-plus-circle"> </i>Tambah Peserta</button>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">#</th>
                                    <th>Nama</th>
                                    <th>keresahan</th>
                                    <th>Hal yang disampaikan</th>
                                    <th>ide</th>
                                    <th style="wi">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sql as $data)
                                <tr>
                                    <td style="text-align: center;width: 20px;">{{$data->PES_ID}}</td>
                                    <td style="width: 30px;">{{$data->NAMA_PES}}</td>
                                    <td style="width: 30px;">{{$data->KERESAHAN}}</td>
                                    <td style="width: 30px;">{{$data->HAL}}</td>
                                    <td style="width: 30px;">{{$data->IDE}}</td>
                                    <td style="width: 30px;">
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#detpes{{$data->PES_ID}}"><i class="feather icon-info"></i></a> 
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editpes{{$data->PES_ID}}"><i class="feather icon-edit"></i></a> 
                                        <a href="/peserta:del={{$data->PES_ID}}" class="btn btn-secondary" onclick="return(confirm('Anda Yakin ?'));"><i class="feather icon-trash"></i></a>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Peserta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{url('/add_peserta')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                @foreach($idp as $id)
                                    <input type="hidden" name="idp" class="form-control" value="{{$id->PES_ID+1}}" readonly="" required="">
                                @endforeach

                                @foreach($idp as $id)
                                    <input type="hidden" name="ida" class="form-control" value="{{$id->ACARA_ID}}" readonly="" required="">
                                @endforeach

                                    <input type="hidden" name="ids" class="form-control" value="{{Session::get('id')}}" readonly="" >
                                <div class="form-group">
                                    <label>Nama </label>
                                    <input type="text" name="nama" class="form-control" placeholder="nama" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" required="">
                                        <option></option>
                                        @foreach($gen as $ge)
                                        <option>{{$ge}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block;">Usia</label>
                                    <input type="number" name="usia" class="form-control col-md-9" placeholder="1 - 70" autocomplete="off" style="display: inline;" required=""> <p style="display: inline-grid;margin-left: 10px;">tahun</p>
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <select class="form-control" name="pend" required="">
                                        <option></option>
                                        @foreach($pen as $pe)
                                        <option>{{$pe}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" name="alam" class="form-control" placeholder="alamat" autocomplete="off" required="" style="resize: none; height: 80px;"></textarea>  
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keresahan / Keluhan</label>
                                    <textarea type="text" name="ker" class="form-control" placeholder="keresahan yang dialami" autocomplete="off" required="" style="resize: none; height: 106px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Hal</label>
                                    <textarea type="text" name="hal" class="form-control" placeholder="hal yang ingin disampaikan" autocomplete="off" required="" style="resize: none; height: 107px;"></textarea> 
                                </div>
                                <div class="form-group">
                                    <label>Ide</label>
                                    <textarea type="text" name="ide" class="form-control" placeholder="Ide yang disarankan" autocomplete="off" required="" style="resize: none; height: 107px;"></textarea>
                                </div>
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



    @foreach($sql as $data)
        <div id="editpes{{$data->PES_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    @php

                        $id = $data->PES_ID;
                        $edit = DB::SELECT("select*from peserta where PES_ID = '$id'");

                    @endphp

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Edit Data @foreach($edit as $nama) {{$nama->NAMA_PES}} @endforeach</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>


                    @foreach($edit as $upd)
                    <form action="/peserta:upd={{$upd->PES_ID}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Nama </label>
                                    <input type="text" name="nama" class="form-control" value="{{$upd->NAMA_PES}}" autocomplete="off" required="">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" required="">
                                      @foreach($gen as $ge)
                                      <?php if ($ge == $upd->GENDER){ ?>
                                           <option value="{{$ge}}" selected="">{{$ge}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$ge}}">{{$ge}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label style="display: block;">Usia</label>
                                    <input type="number" name="usia" class="form-control col-md-9" value="{{$upd->USIA}}" autocomplete="off" style="display: inline;" required=""> <p style="display: inline-grid;margin-left: 10px;">tahun</p>
                                </div>
                                 <div class="form-group">
                                    <label>Pendidikan</label>
                                    <select class="form-control" name="pend" required="">
                                      @foreach($pen as $pe)
                                      <?php if ($pe == $upd->PENDIDIKAN){ ?>
                                           <option value="{{$pe}}" selected="">{{$pe}}</option>
                                        <?php }else{ ?>
                                          <option value="{{$pe}}">{{$pe}}</option>
                                        <?php }?>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" name="alam" class="form-control" autocomplete="off" required="" style="resize: none; height: 80px;">{{$upd->ALAMAT}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keresahan / Keluhan</label>
                                    <textarea type="text" name="ker" class="form-control" autocomplete="off" required="" style="resize: none; height: 106px;">{{$upd->KERESAHAN}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Hal</label>
                                    <textarea type="text" name="hal" class="form-control" autocomplete="off" required="" style="resize: none; height: 107px;">{{$upd->HAL}}</textarea> 
                                </div>
                                <div class="form-group">
                                    <label>Ide</label>
                                    <textarea type="text" name="ide" class="form-control" autocomplete="off" required="" style="resize: none; height: 107px;">{{$upd->IDE}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn  btn-secondary" data-dismiss="modal"><i class="feather icon-x-circle"></i> Batal</button>
                        <button class="btn  btn-danger"> <i class="feather icon-edit"></i> Ubah</button>
                    </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div> 
    @endforeach 



    @foreach($sql as $data)
        <div id="detpes{{$data->PES_ID}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    @php

                        $id = $data->PES_ID;
                        $detail = DB::SELECT("select*from peserta where PES_ID = '$id'");

                    @endphp


                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLiveLabel">Detail Data @foreach($detail as $nama) {{$nama->NAMA_PES}} @endforeach</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    

                    @foreach($detail as $det)
                   

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">

                                <img src="assets/img/rapat.png" width="170" height="180" style="margin: -30px 0px 0px -30px;">
                                
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label style="font-weight: bold;">Nama </label>
                                    <p>{{$det->NAMA_PES}}</p>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;">Gender </label>
                                    <p>{{$det->GENDER}}</p>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;">Usia </label>
                                    <p>{{$det->USIA}} tahun</p>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;">Pendidikan </label>
                                    <p>{{$det->PENDIDIKAN}}</p>
                                </div>
                                <div class="form-group">
                                    <label style="font-weight: bold;">Alamat </label>
                                    <p>{{$det->ALAMAT}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  class="btn  btn-secondary" data-dismiss="modal"><i class="feather icon-x-circle"></i> Tutup</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div> 
    @endforeach
        
@endsection