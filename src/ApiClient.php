<?php

namespace Mralston\Epvs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;
use Mralston\Epvs\Traits\Validations;

class ApiClient
{
    use Validations;

    private string $endpoint = 'https://validationhub.co.uk/api/v1';
    private ?string $token = null;

    private $requestPayload;
    private Response $response;

    public function __construct(?string $token = null, ?string $endpoint = null)
    {
        $this->token = $token ?? config('epvs.token');

        if (!empty($endpoint)) {
            $this->endpoint = Str::of($endpoint)->rtrim('/');
        }
    }

    public function login(string $token)
    {
        $this->token = $token;
    }

    public function getRequestPayload()
    {
        return $this->requestPayload;
    }

    public function getLastResponse(): Response
    {
        return $this->response;
    }
}
