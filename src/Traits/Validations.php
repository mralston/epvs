<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\Validation;

trait Validations
{
    public function getValidations(bool $persist = true): Collection
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/validations')
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return collect($json['data'])
            ->map(
                function ($attributes) use ($persist) {
                    return (
                        Validation::find($attributes['id'] ?? null) ??
                        app(Validation::class)
                    )->fillAndHydrate($attributes, $persist);
                }
            );
    }

    public function showValidation(int $id, bool $persist = true): Validation
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/validations/' . $id)
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return (
            Validation::find($json['data']['id'] ?? null) ??
            app(Validation::class)
        )->fillAndHydrate($json['data'], $persist);
    }

    public function createValidation(array $attributes, bool $persist = true): Validation
    {
        $this->requestPayload = $attributes;

        $this->response = Http::withToken($this->token)
            ->post($this->endpoint . '/validations', $this->requestPayload)
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return app(Validation::class)
            ->fillAndHydrate($json['data'], $persist);
    }
}
