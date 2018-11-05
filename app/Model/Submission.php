<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Submission;

class Submission extends Model
{
  use Sortable;

  protected $primaryKey = 'sid';

  public function order()
  {
    return $this->belongsTo(Order::class);
  }
}
