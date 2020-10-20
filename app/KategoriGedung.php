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
    public $timestamps = 'U';
    
    // soft delete
    protected $dates = ['deleted_at'];

    public function Gedung() {
        return $this->hasMany('App\Gedung', 'id_gedung_kategori', 'id');
    }
}
