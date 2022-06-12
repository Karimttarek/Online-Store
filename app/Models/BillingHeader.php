<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingHeader extends Model
{
    use HasFactory;
    protected $table = 'billingheader';
    protected $guarded = [];
    public $timestamps = true;
}
