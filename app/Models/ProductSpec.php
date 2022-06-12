<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    use HasFactory;

    protected $table = 'product-specifications';
    protected $guarded = [];
    protected $hidden = ['id'];


    public function Product(){
        return $this->belongsToMany(Product::class);
    }
}
