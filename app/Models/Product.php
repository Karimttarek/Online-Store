<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table  = 'products';
    protected $guarded = [];

    protected $hidden = [
        'productType',
//        'stock',
//        'active',
        'entry',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function Spec(){
        return $this->hasMany(ProductSpec::class );
    }
    public function Images(){
        return $this->hasMany(ProductImages::class );
    }
    public function Cart(){
        return $this->hasMany(Cart::class );
    }
    public function Attribuite(){
        return $this->hasMany(Attribuite::class );
    }



    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function Subcategory(){
        return $this->belongsTo(Subcategory::class);
    }
    public function Brand(){
        return $this->belongsTo(Brand::class);
    }

}
