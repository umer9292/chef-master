<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
