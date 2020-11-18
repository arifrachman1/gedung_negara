<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Komponen extends Model
{
    protected $table = 'komponen';
    protected $primaryKey = 'id';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
    
    public function opsi()
    {
        return $this->hasOne('App\KomponenOpsi', 'id', 'id_komponen');
        
    }
}

