<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    public function employees() // REVIEW relationship
    {
        return $this->hasMany('Employee');
    }
}
