<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    public function attributes(){
        return $this->hasMany('App\ProductsAttribute');
    }
}
