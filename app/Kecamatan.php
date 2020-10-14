<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'id_kec';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;

    public function KabupatenKota() {
        return $this->belongsTo('App\KabupatenKota', 'id_kota', 'id_kota');
    }

    public function DesaKelurahan() {
        return $this->hasMany('App\DesaKelurahan', 'id_kec', 'id_kec');
    }
}
