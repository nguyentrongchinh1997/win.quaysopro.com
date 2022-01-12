<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerV2 extends Model
{
    protected $table = 'customer_v2_s';

    protected $fillable = [
        'code', 'name', 'phone', 'status'
    ];
}
