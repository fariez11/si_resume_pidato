<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\RedirectResponse;

use Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Models\User;
use App\Models\acara;
use App\Models\peserta;
use App\Models\kecamatan;
use App\Models\desa;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function actlog(Request $request){
        $username = $request->user;
        $password = $request->pass;
        
        Session::flush();
        $data = DB::table('pengguna')->where([['USERNAME',$username],['PASSWORD',$password]])->get();
        foreach ($data as $key) {
            $nama = $key->USERNAME;
            $level = $key->LEVEL;
        };

        if (count($data) == 0){
            return redirect('/')->with('gagal','.');
        }
        if($level == 1) {
        	$na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
        	foreach ($na as $nam) {
        		Session::put('username',$username);
        		Session::put('nama',$nam->NAMA);
        		Session::put('fp',$nam->FOTO);
                Session::put('id',$nam->USER_ID);
        	}

            return redirect('/bupati');
        }
        else if($level == 2) {

            $na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
        	foreach ($na as $nam) {
        		Session::put('username',$username);
        		Session::put('nama',$nam->NAMA);
        		Session::put('fp',$nam->FOTO);
                Session::put('id',$nam->USER_ID);
        	}

            return redirect('/ajudan');
        }
        else if($level == 3) {

            $na = DB::SELECT("select*from pengguna where USERNAME like '$username'");
        	foreach ($na as $nam) {
        		Session::put('username',$username);
        		Session::put('nama',$nam->NAMA);
        		Session::put('fp',$nam->FOTO);
                Session::put('id',$nam->USER_ID);
        	}

            return redirect('/surveior');
        }
        else {

            return redirect('/')->with('error','.');
        }

    }

    public function bupati(){
        $ac = DB::SELECT("select count(*) as ac from acara");
        $aj = DB::SELECT("select count(*) as aj from pengguna where LEVEL = 2");
        $re = DB::SELECT("select count(*) as re from peserta");

    	return view('/bupati/home',['ac'=> $ac,'aj'=> $aj,'re'=> $re]);
    }

    public function dtresume(){

        $sql = DB::SELECT("select*from acara a, desa b, kecamatan c where a.ALAMAT = b.WIL_ID and b.KEC = c.KEC_ID order by TGL DESC");
        return view('/bupati/dt_resume',['sql'=>$sql]);
    }

    public function updresume(Request $request, $id)
    {
        $re = $request->res;

            $data = DB::table('acara')->where('ACARA_ID',$id)->update(['RESUME'=>$re]);
        
        return back()->with('updacara','.');
    }




    
    public function ajudan(){
        $ac = DB::SELECT("select count(*) as ac from acara");
        $aj = DB::SELECT("select count(*) as aj from pengguna where LEVEL = 2");
        $su = DB::SELECT("select count(*) as su from pengguna where LEVEL = 3");
        $re = DB::SELECT("select count(*) as re from peserta");

        return view('/ajudan/home',['ac'=> $ac,'aj'=> $aj,'re'=> $re,'su'=>$su]);
    }
    
    public function dtacara(){
        $ida = acara::getId();
        $sql = DB::SELECT("select*from acara a, desa b, kecamatan c where a.ALAMAT = b.WIL_ID and b.KEC = c.KEC_ID");
        $dkc = DB::SELECT("select*from kecamatan a, desa b where a.KEC_ID = b.KEC and b.DESA not like '-'");

        return view('/ajudan/dt_acara',['sql'=>$sql,'ida'=>$ida,'dkc'=>$dkc]);
    }

    public function addacara(Request $request)
    {
          $id = $request->ida;
          $na = $request->nama;
          $tg = $request->tgl;
          $te = $request->tempat;
          $al = $request->alamat;


        $data = new acara();
            $data->ACARA_ID = $id;
            $data->ACARA = ucfirst($na);
            $data->TGL = $tg;
            $data->TEMPAT = ucfirst($te);
            $data->ALAMAT = $al;
            $data->save();

        return redirect('dt_acara')->with('addacara','.');
    }

    public function updacara(Request $request,$id)
    {
        $na = $request->nama;
        $tg = $request->tgl;
        $te = $request->tempat;
        $al = $request->alamat;

            $data = DB::table('acara')->where('ACARA_ID',$id)->update(['ACARA'=>ucfirst($na),'TGL'=>$tg,'TEMPAT'=>$te,'ALAMAT'=>$al]);
        
        return redirect('dt_acara')->with('updacara','.');
    }

    public function delacara($id)
    {
            DB::table('acara')->where('ACARA_ID',$id)->delete();

            return redirect('dt_acara')->with('delacara','.');

    }


    public function adtpes($id){
        $ida = $id;
        $sql = DB::SELECT("select*from peserta a, pengguna b where a.USER_ID = b.USER_ID and a.ACARA_ID = '$id'");

        return view('/ajudan/dt_peserta',['sql'=>$sql,'ida'=>$ida]);
    }

    public function addresume(Request $request)
    {
        $ia = $request->ia;
        $re = $request->res;

            $data = DB::table('acara')->where('ACARA_ID',$ia)->update(['RESUME'=>$re]);
        
        return back()->with('updacara','.');
    }







    public function surveior(){
        $ac = DB::SELECT("select count(*) as ac from acara");
        $re = DB::SELECT("select count(*) as re from peserta");

        return view('/surveior/home',['ac'=> $ac,'re'=> $re]);
    }

    public function sdtacara(){
        $sql = DB::SELECT("select*from acara");

        return view('/surveior/dt_acara',['sql'=>$sql]);
    }

    public function dtpes($id){
        $idp = peserta::getId();
        $ida = $id;
        $sql = DB::SELECT("select*from peserta where ACARA_ID = '$id'");

        return view('/surveior/dt_peserta',['sql'=>$sql,'idp'=>$idp,'ida'=>$ida]);
    }

    public function addpes(Request $request)
    {
          $idp = $request->idp;
          $ida = $request->ida;
          $ids = $request->ids;
          $nam = $request->nama;
          $gen = $request->gender;
          $usi = $request->usia;
          $pen = $request->pend;
          $ala = $request->alam;
          $ker = $request->ker;
          $hal = $request->hal;
          $ide = $request->ide;


        $data = new peserta();
            $data->PES_ID = $idp;
            $data->ACARA_ID = $ida;
            $data->USER_ID = $ids;
            $data->NAMA_PES = ucfirst($nam);
            $data->GENDER = ucfirst($gen);
            $data->USIA = $usi;
            $data->PENDIDIKAN = $pen;
            $data->ALAMAT = $ala;
            $data->KERESAHAN = $ker;
            $data->HAL = $hal;
            $data->IDE = $ide;
            $data->save();

        return back()->with('addacara','.');
    }

    public function updpes(Request $request,$id)
    {
          $nam = $request->nama;
          $gen = $request->gender;
          $usi = $request->usia;
          $pen = $request->pend;
          $ala = $request->alam;
          $ker = $request->ker;
          $hal = $request->hal;
          $ide = $request->ide;

            $data = DB::table('peserta')->where('PES_ID',$id)->update(['NAMA_PES'=>ucfirst($nam),'GENDER'=>ucfirst($gen),'USIA'=>$usi,'PENDIDIKAN'=>$pen,'ALAMAT'=>$ala,'KERESAHAN'=>$ker,'HAL'=>$hal,'IDE'=>$ide]);
        
        return back()->with('updacara','.');
    }

    public function delpes($id)
    {
            DB::table('peserta')->where('PES_ID',$id)->delete();

            return back()->with('delacara','.');

    }




    public function logout(){

        Session::flush();
        return redirect('/');
    }
}
