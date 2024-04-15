<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoffeeOrder extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['quantity', 'unit_price','selling_price','user_id', 'brand'];

    public function coffeeBrand() {
        return $this->belongsTo('App\Models\COffeeBrand', 'brand');
    }
}