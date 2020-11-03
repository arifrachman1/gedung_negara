<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomponenOpsi extends Model
{
    protected $table = 'komponen_opsi';
    protected $primaryKey = 'id';

    public function opsi()
    {
        return $this->BelongsTo(komponen::class,'id');
        
    }
}
