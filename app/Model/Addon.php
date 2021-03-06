<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Race;

class Addon extends Model
{
  use Sortable;

  public $sortable = ['add_en'];

  protected $primaryKey = 'aid';

  public function race()
  {
    return $this->belongsTo(Race::class);
  }

  public function orderaddon()
  {
    return $this->hasMany(OrderAddon::class);
  }
}
