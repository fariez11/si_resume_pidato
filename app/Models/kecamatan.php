<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $fillable = [
        'KEC_ID', 'NAMA_KEC'
        ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('kecamatan')->orderBy('KEC_ID','DESC')->take(1)->get();
    }
}
