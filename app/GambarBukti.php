<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarBukti extends Model
{
    protected $table = 'gambar_bukti';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
