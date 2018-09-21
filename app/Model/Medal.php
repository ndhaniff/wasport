<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Race;

class Medal extends Model
{
  use Sortable;

  public $sortable = ['name'];

  protected $primaryKey = 'mid';

  public function race()
  {
    return $this->belongsTo(Race::class);
  }
}
