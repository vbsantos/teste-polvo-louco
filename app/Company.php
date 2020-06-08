<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $guarded = ['id'];
  protected $fillable = ["name", "email", "site", "logo"];
  public function employees()
  {
    return $this->hasMany('App\Employee');
  }
}
