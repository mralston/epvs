<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\InsuranceProvider;

trait InsuranceProviders
{
    public function getInsuranceProviders(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/installer/authorised-insurance-providers')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        InsuranceProvider::find($attributes['id'] ?? null) ??
                        app(InsuranceProvider::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }
}
