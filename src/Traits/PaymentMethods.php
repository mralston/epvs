<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\PaymentMethod;

trait PaymentMethods
{
    public function getPaymentMethods(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/installer/authorised-payment-methods')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        PaymentMethod::find($attributes['id'] ?? null) ??
                        app(PaymentMethod::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }
}
