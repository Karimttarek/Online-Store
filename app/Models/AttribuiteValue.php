<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttribuiteValue extends Model
{
    use HasFactory;

    protected $table = 'attribuite-values';
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo(Attribuite::class);
    }
}
