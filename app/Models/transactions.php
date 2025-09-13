<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(accounts::class, 'account_id', 'id');
    }
}
