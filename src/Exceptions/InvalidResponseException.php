<?php

namespace Mralston\Epvs\Exceptions;

use Exception;

class InvalidResponseException extends Exception
{
    protected $message = 'Invalid Response';
    protected $response;
}