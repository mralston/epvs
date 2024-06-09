<?php

use Illuminate\Support\Facades\Route;
use Mralston\Epvs\Http\Controllers\WebhookController;

Route::post('/epvs/webhook/validation-status-updated', [WebhookController::class, 'validationStatusUpdated'])
    ->name('epvs.webhook.validation-status-updated');