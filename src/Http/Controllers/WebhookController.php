<?php

namespace Mralston\Epvs\Http\Controllers;

use Illuminate\Http\Request;
use Mralston\Epvs\Events\WebhookReceived;

/**
 * Statuses:
 *
 * 1 Validated
 * 2 Awaiting Compliance Call
 * 3 Cancelled Worked
 * 4 Cancelled Not Worked
 * 5 Declined
 * 6 Further Info Requested
 * 7 Pending
 * 8 Registered
 */

class WebhookController
{
    public function __invoke(Request $request)
    {
        event(new WebhookReceived($request->all()));

        return response('Received', 200);
    }
}