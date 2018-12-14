<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    //
    public function gudang(){
    	return $this->belongsTo('\App\gudang','gudang_id');
    }
}
