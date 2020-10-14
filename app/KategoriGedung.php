<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriGedung extends Model
{
    protected $table = 'gedung_ketegori';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;
}
