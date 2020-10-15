<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gedung extends Model
{
    use SoftDeletes;

    protected $table = 'gedung';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = 'U';
    
    // soft delete
    protected $dates = ['deleted_at'];

    public function kategoriGedung() {
        return $this->belongsTo('App\KategoriGedung', 'id', 'id_gedung_kategori');
    }
}
