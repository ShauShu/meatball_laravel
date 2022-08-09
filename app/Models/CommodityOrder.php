<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
class CommodityOrder extends Pivot
{
    use HasFactory;
    // protected $fillable = [
    //     'price',
    //     'count',
    //     'commodity_id',
    //     'order_id',
    // ];
    // public function comm_change(){
    //     return  $this->belongsTo('App\Models\Comm_change');  
    // }
}
