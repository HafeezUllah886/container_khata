<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class export extends Model
{
    protected $guarded = [];

    public function consignee()
    {
        return $this->belongsTo(accounts::class, 'consignee_id');
    }

    public function info_party()
    {
        return $this->belongsTo(accounts::class, 'info_party_id');
    }

    public function export_cars()
    {
        return $this->hasMany(export_cars::class);
    }

    public function export_engines()
    {
        return $this->hasMany(export_engines::class);
    }

    public function export_parts()
    {
        return $this->hasMany(export_parts::class);
    }

    public function export_misc()
    {
        return $this->hasMany(export_misc::class);
    }
    
}
