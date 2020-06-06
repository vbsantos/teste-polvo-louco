<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    public function Company() // REVIEW relationship
    {
        return $this->belongsTo('Company');
    }
}
