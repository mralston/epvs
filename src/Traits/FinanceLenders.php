<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\FinanceLender;

trait FinanceLenders
{
    public function getFinanceLenders(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/installer/authorised-finance-lenders')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        FinanceLender::find($attributes['id'] ?? null) ??
                        app(FinanceLender::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }
}
