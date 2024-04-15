<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeBrand extends Model
{
    use HasFactory;

    protected $fillable = ['brand_name', 'profit_margin'];

    public function coffeeOrders() {
        return $this->hasMany('App\Models\CoffeeOrder', 'id');
    }

}