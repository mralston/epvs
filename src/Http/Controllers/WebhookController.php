<?php

namespace Mralston\Epvs\Http\Controllers;

use Illuminate\Http\Request;
use Mralston\Epvs\Events\ValidationAwaitingComplianceCall;
use Mralston\Epvs\Events\ValidationCancelled;
use Mralston\Epvs\Events\ValidationCancelledNotWorked;
use Mralston\Epvs\Events\ValidationCancelledWorked;
use Mralston\Epvs\Events\ValidationDeclined;
use Mralston\Epvs\Events\ValidationFurtherInfoRequested;
use Mralston\Epvs\Events\ValidationPending;
use Mralston\Epvs\Events\ValidationRegistered;
use Mralston\Epvs\Events\ValidationStatusUpdated;
use Mralston\Epvs\Events\ValidationValidated;
use Mralston\Epvs\Events\WebhookReceived;

class WebhookController
{
    protected array $statusEventMap = [
        1 => ValidationValidated::class,
        2 => ValidationAwaitingComplianceCall::class,
        3 => [
            ValidationCancelledWorked::class,
            ValidationCancelled::class,
        ],
        4 => [
            ValidationCancelledNotWorked::class,
            ValidationCancelled::class,
        ],
        5 => ValidationDeclined::class,
        6 => ValidationFurtherInfoRequested::class,
        7 => ValidationPending::class,
        8 => ValidationRegistered::class,
    ];

    public function validationStatusUpdated(Request $request)
    {
        event(new WebhookReceived($request->all()));
        event(new ValidationStatusUpdated($request->all()));

        if (isset($this->statusEventMap[$request->input('status_id')])) {
            $events = is_array($this->statusEventMap[$request->input('status_id')]) ?
                $this->statusEventMap[$request->input('status_id')] :
                [$this->statusEventMap[$request->input('status_id')]];

            foreach ($events as $event) {
                event(new $event($request->all()));
            }
        }

        return response('Received', 200);
    }
}