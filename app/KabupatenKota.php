<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    protected $table = 'kota';
    protected $primaryKey = 'id_kota';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;

    public function Provinsi() {
        return $this->belongsTo('App\Provinsi', 'id_prov', 'id_prov');
    }

    public function Kecamatan() {
        return $this->hasMany('App\Kecamatan', 'id_kota', 'id_kota');
    }
}
