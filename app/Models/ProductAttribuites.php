<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribuites extends Model
{
    use HasFactory;

    protected $table = 'product-attribuites';
    protected $guarded = [];
    protected $hidden = ['id'];


    public function Product(){
        return $this->belongsToMany(Product::class);
    }
}
