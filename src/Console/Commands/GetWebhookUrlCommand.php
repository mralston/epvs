<?php

namespace Mralston\Epvs\Console\Commands;

use Illuminate\Console\Command;

class GetWebhookUrlCommand extends Command
{
    protected $signature = 'epvs:webhook-url';

    protected $description = 'Returns the webhook URL to be set in the EPVS Validation Hub portal.';

    public function handle(): void
    {
        $this->info(route('epvs.webhook'));
    }
}
