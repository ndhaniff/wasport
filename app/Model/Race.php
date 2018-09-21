<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Model\Addon;
use App\Model\Medal;

class Race extends Model
{
    use Sortable;

    public $sortable = ['title_en', 'date_from', 'date_to'];

    protected $primaryKey = 'rid';

    public function addons()
    {
      return $this->hasMany(Addon::class);
    }

    public function medals()
    {
      return $this->hasMany(Medal::class);
    }
}
