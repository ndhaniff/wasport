<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\OrderAddon;

class OrderAddon extends Model
{
  use Sortable;

  protected $primaryKey = 'oaid';

  public function order()
  {
    return $this->belongsTo(Order::class);
  }

  public function addon()
  {
    return $this->belongsTo(Addon::class);
  }
}
