<?php

namespace Mralston\Epvs\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mralston\Epvs\ApiClient
 * @method static \Illuminate\Http\Client\Response getLastResponse()
 *
 * @see \Mralston\Epvs\Traits\Validations
 * @method static \Illuminate\Support\Collection getValidations()
 * @method static \Mralston\Epvs\Models\Validation showValidation(int $id)
 * @method static \Mralston\Epvs\Models\Validation createValidation(array $attrs)
 */
class Epvs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'epvs';
    }
}
