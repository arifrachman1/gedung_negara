<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kerusakan extends Model
{
    use SoftDeletes;
    protected $table = 'kerusakan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
        
    protected $dates = ['deleted_at'];
}
