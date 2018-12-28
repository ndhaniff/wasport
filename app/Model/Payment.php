<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use Sortable;

    public $sortable = ['pid'];

    protected $primaryKey = 'pid';

}
