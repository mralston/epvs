<?php

namespace Mralston\Epvs\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ValidationValidated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $data;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data) {
        $this->data = $data;
    }
}