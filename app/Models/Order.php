<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommodityOrder;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'rname',
        'rphone',
        'raddress',
        'pay',
        'state',
    ];
    public function user(){
        return  $this->belongsTo('App\Models\User');  
    }
    public function commodities(){
        return $this->belongsToMany('App\Models\Commodity')->using(CommodityOrder::class);
    }
}
