<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomponenOpsi extends Model
{
    protected $table = 'komponen_opsi';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = 'U';
    // soft delete
    protected $dates = ['deleted_at'];
}
