<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Models\Validation;

trait Certificates
{
    public function getCertificate(Validation $validation): string
    {
        return Http::withToken(config('epvs.token'))
            ->get(config('epvs.dashboard') . '/validations/' . $validation->id . '/download-certificate')
            ->throw()
            ->body();
    }
}