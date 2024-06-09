<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\ProductType;

trait ProductTypes
{
    public function getProductTypes(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/installer/authorised-product-types')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        ProductType::find($attributes['id'] ?? null) ??
                        app(ProductType::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }
}
