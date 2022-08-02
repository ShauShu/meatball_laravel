<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'price',
        'type',
        'info',
        'pic',
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

}
