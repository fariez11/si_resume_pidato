<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class desa extends Model
{
    use HasFactory;

    protected $table = 'desa';
    protected $fillable = [
        'WIL_ID', 'KEC','DESA'
        ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('desa')->orderBy('WIL_ID','DESC')->take(1)->get();
    }
}
