<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'product-images';
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
