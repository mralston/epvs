<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Mralston\Epvs\Exceptions\InvalidResponseException;
use Mralston\Epvs\Models\Validation;

trait Validations
{
    public function getValidations(): Collection
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
                fn ($validation) => app(Validation::class)
                    ->forceFill($validation)
                    ->hydrate()
            );
    }

    public function showValidation(int $id): Validation
    {
        $this->response = Http::withToken($this->token)
            ->get($this->endpoint . '/validations/' . $id)
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return app(Validation::class)
            ->forceFill($json['data'])
            ->hydrate();
    }

    public function createValidation(array $attrs): Validation
    {
        $this->response = Http::withToken($this->token)
            ->post($this->endpoint . '/validations', $attrs)
            ->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw new InvalidResponseException();
        }

        return app(Validation::class)
            ->forceFill($json['data'])
            ->hydrate();
    }
}
