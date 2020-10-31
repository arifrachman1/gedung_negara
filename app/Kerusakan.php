<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    protected $table = 'kerusakan';
    protected $primaryKey = 'id';
    protected $guarded = [];
//    / protected $fillable = ['id_parent']; //nama kolom yang ingin di masukkan
    public $timestamps = false;
}
