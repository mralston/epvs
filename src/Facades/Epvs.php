<?php

namespace Mralston\Epvs\Facades;

use Illuminate\Support\Facades\Facade;
use Mralston\Epvs\Models\Validation;

/**
 * @see \Mralston\Epvs\ApiClient
 * @method static void login(string $token)
 * @method static array getRequestPayload()
 * @method static \Illuminate\Http\Client\Response getLastResponse()
 *
 * @see \Mralston\Epvs\Traits\Certificates
 * @method static string getCertificate(Validation $validation)
 *
 * @see \Mralston\Epvs\Traits\Files
 * @method static \Mralston\Epvs\Models\File upload(string $content, string $filename, ?Validation $validation = null, bool $persist = true)
 * @method static \Mralston\Epvs\Models\File uploadFromFilesystem(string $path, ?Validation $validation = null, bool $persist = true)
 * @method static \Mralston\Epvs\Models\File uploadFromStorage(string $disk, $path, ?Validation $validation = null, bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\FinanceBrokers
 * @method static \Illuminate\Support\Collection getFinanceBrokers(bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\FinanceLenders
 * @method static \Illuminate\Support\Collection getFinanceLenders(bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\InsuranceProviders
 * @method static \Illuminate\Support\Collection getInsuranceProviders(bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\PaymentMethods
 * @method static \Illuminate\Support\Collection getPaymentMethods(bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\ProductTypes
 * @method static \Illuminate\Support\Collection getProductTypes(bool $persist = true)
 *
 * @see \Mralston\Epvs\Traits\Validations
 * @method static \Illuminate\Support\Collection getValidations(bool $persist = true)
 * @method static \Mralston\Epvs\Models\Validation showValidation(int $id, bool $persist = true)
 * @method static \Mralston\Epvs\Models\Validation createValidation(array $attributes, bool $persist = true)
 *
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
