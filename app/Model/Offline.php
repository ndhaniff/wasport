<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Offline;

class Offline extends Model
{
  use Sortable;

  public $sortable = ['title_en', 'state'];

  protected $primaryKey = 'fid';
}
