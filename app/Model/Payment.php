<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Payment extends Model
{
    use Sortable;

    public $sortable = ['pid', 'p_status', 'amount_paid', 'created_at'];

    protected $primaryKey = 'pid';

}
