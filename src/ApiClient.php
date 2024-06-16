<?php

namespace Mralston\Epvs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Str;
use Mralston\Epvs\Traits\Files;
use Mralston\Epvs\Traits\FinanceBrokers;
use Mralston\Epvs\Traits\FinanceLenders;
use Mralston\Epvs\Traits\InsuranceProviders;
use Mralston\Epvs\Traits\PaymentMethods;
use Mralston\Epvs\Traits\ProductTypes;
use Mralston\Epvs\Traits\Validations;

class ApiClient
{
    use Files;
    use FinanceBrokers;
    use FinanceLenders;
    use InsuranceProviders;
    use PaymentMethods;
    use ProductTypes;
    use Validations;

    private string $endpoint = 'https://validationhub.co.uk/api/v1';
    private ?string $token = null;

    private $requestPayload;
    private ?Response $response;

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

    public function getLastResponse(): ?Response
    {
        return $this->response ?? null;
    }
}
