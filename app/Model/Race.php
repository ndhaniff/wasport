<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    public function addons()
    {
      return $this->hasMany(Addons::class);
    }
}
