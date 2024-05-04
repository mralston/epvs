<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;

class Installer extends Model
{
    protected $fillable = [
        'name',
        'xero_contact_link',
        'readable_membership_status',
    ];
}