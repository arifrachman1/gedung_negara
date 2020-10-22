<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Satuan extends Model
{
    
    // use SoftDeletes;
    protected $table = 'satuan';
    protected $primaryKey = 'id';
    
   	// protected $dates = ['deleted_at'];

    public function satuan()
    {
        return $this->BelongsTo(komponen::class,'id');
        
    }
}
