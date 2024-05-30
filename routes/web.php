<?php

use Illuminate\Support\Facades\Route;
use Mralston\Epvs\Http\Controllers\WebhookController;

Route::post('/epvs/webhook', WebhookController::class)->name('epvs.webhook');