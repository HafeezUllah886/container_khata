<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class export_parts extends Model
{
    protected $guarded = [];

    public function export()
    {
        return $this->belongsTo(export::class);
    }

    public function part()
    {
        return $this->belongsTo(parts::class);
    }
}
