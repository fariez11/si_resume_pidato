<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class acara extends Model
{
    use HasFactory;

    protected $table = 'acara';
    protected $fillable = [
        'ACARA_ID', 'USER_ID', 'ACARA','TGL','TEMPAT','RESUME'
        ];

    public $timestamps = false;

    public static function getId(){
        return $getId = DB::table('acara')->orderBy('ACARA_ID','DESC')->take(1)->get();
    }
}
