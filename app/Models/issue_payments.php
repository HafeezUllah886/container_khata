<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class issue_payments extends Model
{
    protected $guarded = [];

    public function payment_category()
    {
        return $this->belongsTo(payment_categories::class,'category_id','id');
    }
}
