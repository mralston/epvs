<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;

class FinanceLender extends Model
{
    protected $fillable = [
        'name',
        'xero_contact_link',
    ];
}