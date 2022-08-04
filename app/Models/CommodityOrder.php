<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommodityOrder extends Pivot
{
    public function comm_change(){
        return  $this->belongsTo('Comm_change');  
    }
}
