<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    protected $table = 'komponen';
    protected $primaryKey = 'id';
    protected $guarded = [];
//    / protected $fillable = ['id_parent']; //nama kolom yang ingin di masukkan
    public $timestamps = false;

    public function satuan()
    {
        return $this->hasOne('App\Satuan', 'id', 'id_satuan');
        
    }

    public function komponen()
    {
        return $this->belongsTo(self::class, 'id_parent');
    }

    public function subKomponen()
    {
        return $this->hasMany(self::class, 'id_parent');
    }
}

