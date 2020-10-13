<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriGedung extends Model
{
    use SoftDeletes;

    protected $table = 'gedung_ketegori';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    protected $timestamps = false;
}
