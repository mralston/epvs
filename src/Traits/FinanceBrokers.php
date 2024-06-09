<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\FinanceBroker;

trait FinanceBrokers
{
    public function getFinanceBrokers(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/installer/authorised-finance-brokers')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        FinanceBroker::find($attributes['id'] ?? null) ??
                        app(FinanceBroker::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }
}
