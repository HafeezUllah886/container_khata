<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class export_misc extends Model
{
    protected $guarded = [];

    public function export()
    {
        return $this->belongsTo(export::class);
    }
}
