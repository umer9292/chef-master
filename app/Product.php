<?php

namespace App;

use App\Category;
use App\Company;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $guarded = [];
}
