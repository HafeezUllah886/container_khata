<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment_categories extends Model
{
    protected $fillable = [
        'name',
        'for',
    ];
}
