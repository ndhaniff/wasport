<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
  use Sortable;

  public $sortable = ['name', 'email', 'category'];

  protected $primaryKey = 'cid';
}
