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
        'description',
        'pic',
    ];
    protected $hidden=['pivot'];
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
    public function orders(){
        return $this->belongsToMany('App\Models\Order');
    }
    public function comm_changes(){
        return $this->hasMany('App\Models\Comm_change');
    }
   
}
