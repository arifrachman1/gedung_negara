<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'id';

    public function satuan()
    {
        return $this->BelongsTo(komponen::class,'id');
        
    }
}
