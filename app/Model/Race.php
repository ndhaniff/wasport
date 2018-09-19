<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Race extends Model
{
    use Sortable;

    public $sortable = ['title_en', 'date_from', 'date_to'];

    public function addons()
    {
      return $this->hasMany(Addons::class);
    }
}
