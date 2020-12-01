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
    public $timestamps = 'U';
    protected $fillable = [
        'name'
        ];
    
    // soft delete
    protected $dates = ['deleted_at'];

    public function kategoriGedung() {
        return $this->belongsTo('App\KategoriGedung', 'id_gedung_kategori', 'id');
    }

    public function kerusakans()
    {
        return $this->hasMany(Kerusakan::class, 'id_gedung');
    }
    
}
