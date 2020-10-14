<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''] //nama kolom yang ingin di masukkan
    public $timestamps = false;
}

