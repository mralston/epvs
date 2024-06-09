<?php

namespace Mralston\Epvs\Console\Commands;

use Illuminate\Console\Command;
use Mralston\Epvs\Events\WebhookReceived;
use Mralston\Epvs\Facades\Epvs;

class CheckStatus extends Command
{
    protected $signature = 'epvs:check-status {validation}';

    protected $description = 'Checks the status of of a validation.';

    public function handle(): void
    {
        $validation = Epvs::showValidation($this->argument('validation'));

        $this->info($validation->validation_status->id . ': ' . $validation->validation_status->name);

        event(new WebhookReceived([
            'validation_id' => $validation->id,
            'status_id' => $validation->validation_status->id,
            'status_name' => $validation->validation_status->name,
        ]));
    }



}
