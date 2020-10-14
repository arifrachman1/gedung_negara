<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    protected $primaryKey = 'id_prov';
    protected $guarded = [];
    // protected $fillable = [''];
    public $timestamps = false;

    public function kabupatenKota() {
        return $this->hasMany('App\KabupatenKota', 'id_prov', 'id_prov');
    }
}
