<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomponenOpsi extends Model
{
    protected $table = 'komponen_opsi';
    protected $primaryKey = 'id';
    // protected $fillable = [''];
    public $timestamps = false;

    public function opsi()
    {
        return $this->BelongsTo(komponen::class,'id');
    }
}
