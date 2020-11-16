<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KerusakanKlasifikasi extends Model
{
    protected $table = 'kerusakan_klasifikasi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
