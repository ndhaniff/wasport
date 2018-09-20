<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class User extends Model
{
  use Sortable;

  public $sortable = ['id', 'name', 'email', 'firstname', 'lastname'];
}
