<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Order;

class Order extends Model
{
  use Sortable;

  public $sortable = ['firstname, lastname'];

  protected $primaryKey = 'oid';

  public function race()
  {
    return $this->belongsTo(Race::class);
  }

  public function submission()
  {
    return $this->hasMany(Submission::class);
  }

  public function orderaddon()
  {
    return $this->hasMany(OrderAddon::class);
  }
}
