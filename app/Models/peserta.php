<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';
    protected $fillable = [
        'PES_ID', 'ACARA_ID', 'USER_ID', 'NAMA_PES','GENDER','USIA','ALAMAT','PENDIDIKAN','HAL','IDE','KERESAHAN'
        ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('peserta')->orderBy('PES_ID','DESC')->take(1)->get();
    }

}
