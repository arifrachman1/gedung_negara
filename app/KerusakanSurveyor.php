<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KerusakanSurveyor extends Model
{
    protected $table = 'kerusakan_surveyor';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
