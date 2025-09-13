<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class export_cars extends Model
{
    protected $guarded = [];

    public function export()
    {
        return $this->belongsTo(export::class);
    }

    public function purchase()
    {
        return $this->belongsTo(purchase::class);
    }
}
