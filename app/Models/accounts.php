<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class accounts extends Model
{
    protected $guarded = [];

    public function scopeConsignee($query)
    {
        return $query->where('type', 'Consignee');
    }

    public function scopeTransporter($query)
    {
        return $query->where('type', 'Transporter');
    }

    public function scopeBank($query)
    {
        return $query->where('type', 'Bank');
    }
}
