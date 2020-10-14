<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesaKelurahan extends Model
{
    protected $table = 'kelurahan';
    protected $primaryKey = 'id_kel';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;

    public function Kecamatan() {
        return $this->belongsTo('App\Kecamatan', 'id_kota', 'id_kota');
    }
}
