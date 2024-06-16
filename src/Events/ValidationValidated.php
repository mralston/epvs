<?php

namespace Mralston\Epvs\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Mralston\Epvs\Models\Validation;

class ValidationValidated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public array $data;

    protected Validation $validation;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data) {
        $this->data = $data;
    }

    public function validation(): Validation
    {
        if (empty($this->validation)) {
            $this->validation = Validation::find($this->data['validation_id']);
        }

        return $this->validation;
    }
}