<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Addon extends Model
{
  public function race()
  {
    return $this->belongsTo(Race::class);
  }
}
