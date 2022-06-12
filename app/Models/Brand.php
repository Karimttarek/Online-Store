<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'Brands';

    protected $fillable = [
        'id',
        'name',
        'name_ar'
    ];

}
