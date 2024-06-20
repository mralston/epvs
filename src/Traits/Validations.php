<?php

namespace Mralston\Epvs\Traits;

use Illuminate\Database\Eloquent\Model;
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

    public function createValidation(array $attributes, bool $persist = true, ?Model $parent = null): Validation
    {
        $this->requestPayload = array_merge($attributes, [
            'file_empty_warning' => 1 // TODO: Support adding files
        ]);

        $this->response = Http::withToken($this->token)
            ->asMultipart()
            ->acceptJson()
            ->post($this->endpoint . '/validations', $this->requestPayload);

        $this->response->throw();

        $json = $this->response->json();

        if (is_null($json)) {
            throw (new InvalidResponseException())->setResponse($this->response);
        }

        $validation = app(Validation::class)
            ->fillAndHydrate($json['data'], false);

        // Normally this would be done with $validation->validationable()->associate($parent)->save()
        // but for some reason it isn't persisting to the database, so we're doing it manually instead.
        if (!empty($parent)) {
            $validation->validationable_type = get_class($parent);
            $validation->validationable_id = $parent->id;
        }

        if ($persist) {
            $validation->save();
        }

        return $validation;;
    }
}
