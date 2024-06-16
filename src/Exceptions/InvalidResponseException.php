<?php

namespace Mralston\Epvs\Exceptions;

use Exception;
use Illuminate\Http\Client\Response;

class InvalidResponseException extends Exception
{
    protected $message = 'Invalid Response';
    protected Response $response;

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse($response): self
    {
        $this->response = $response;
        return $this;
    }
}