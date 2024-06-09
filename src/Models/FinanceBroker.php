<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class FinanceBroker extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_finance_brokers';

    protected $fillable = [
        'name',
        'xero_contact_link',
    ];
}