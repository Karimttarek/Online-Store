<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $timestamps = false;
    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
