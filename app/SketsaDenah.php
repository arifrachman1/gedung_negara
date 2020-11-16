<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SketsaDenah extends Model
{
    protected $table = 'sketsa_denah';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
