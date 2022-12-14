<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comm_change extends Model
{
    use HasFactory;

    protected $fillable = [
        'count',
        'commodity_id'
    ];

    public function commodity(){
        return  $this->belongsTo('App\Models\Commodity');  
    }
    public function commodityorder(){
        return $this->belongsTo('App\Models\CommodityOrder');
    }

}
