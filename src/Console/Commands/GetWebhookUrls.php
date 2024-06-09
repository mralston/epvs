<?php

namespace Mralston\Epvs\Console\Commands;

use Illuminate\Console\Command;

class GetWebhookUrls extends Command
{
    protected $signature = 'epvs:webhooks';

    protected $description = 'Returns the webhook URLs to be set in the EPVS Validation Hub portal.';

    public function handle(): void
    {
        $this->info('VALIDATION_STATUS_UPDATED:');
        $this->info(route('epvs.webhook.validation-status-updated'));
    }
}
