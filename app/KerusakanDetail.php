<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KerusakanDetail extends Model
{
    protected $table = 'kerusakan_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
