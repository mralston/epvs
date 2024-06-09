# Certi-fi EPVS

## Introduction

Library for working with the Certi-fi EPVS API.

## Config

You may publish the config file as follows:

```bash
php artisan vendor:publish --tag=epvs-config
```

Add the following items to your .env file:

```dotenv
EPVS_TOKEN=
#EPVS_ENDPOINT=
```

`EPVS_TOKEN` is set up on the EPVS Validation Hub web interface at:

> Account Settings > Personal Access Tokens > API Keys > Create Token
 
`EPVS_ENDPOINT` may be uncommented and specified if Certi-fi provide a custom API endpoint. In most cases however, the package's default value of `https://validationhub.co.uk/api/v1` will be sufficient.

## Usage

Here are how the basic functions of the library work:

```php
use Mralston\Epvs\Facades\Epvs;

$validations = Epvs::getValidations(); // Illuminate\Support\Collection

$validation = Epvs::showValidation(123); // Mralston\Epvs\Models\Validation

$newValidation = Epvs::createValidation([ // Mralston\Epvs\Models\Validation
    'product_type_id' => 234,
    'customer_first_name' => 'Test Michael',
    'customer_last_name' => 'Test Burnham',
    'customer_phone' => '01234567890',
    'customer_email' => 'michael.burnham@starfleet.com',
    'installation_address_line_1' => 'USS Discovery',
    'installation_address_line_2' => 'null',
    'installation_address_line_3' => 'null',
    'installation_area_town' => 'Space',
    'installation_county' => 'Cosmos',
    'installation_postcode' => 'SP4 0CE',
    'payment_method_id' => 2,
    'finance_lender_id' => 9,
    'finance_reference' => '54321-0987',
    'finance_term_length' => 36,
    'finance_broker_id' => 8,
    'insurance_provider_id' => 6,
    'ibg_policy_number' => '1234',
    'sales_person_name' => 'Gabriel Lorca',
    'total_contract_value' => 15123,
    'deposit_paid' => 650,
    'date_contract_signed' => '2024-05-03',
    'file_empty_warning' => 1,
    'file_tokens' => [],
]);
```

## Webhooks

Webhook can be configured on your EPVS Validation Hub portal, allowing you to receive real-time updates, for example when the status of a validation changes.

The following Artisan command generates the URL of each webhook, ready to be pasted into the EPVS Validation Hub:

```bash
$ php artisan epvs:webhooks
```

Add a new webhook on your profile page on the EPVS Validation Hub and copy and paste the URL provided.

Whenever the status of a validation changes or another webhook-backed event occurs, a `WebhookRecieved` event will be fired in your application. The `data` property contains information about the event. In the case of a VALIDATION_STATUS_UPDATED event, the data property will contain an array similar to the following:

```
(
    [validation_id] => 2
    [status_id] => 1
    [status_name] => Validated
)
```

The following statuses are currently defined by the EPVS Validation Hub:

| Status ID | Status Name              |
|-----------|--------------------------|
| 1         | Validated                |
| 2         | Awaiting Compliance Call |
| 3         | Cancelled Worked         |
| 4         | Cancelled Not Worked     |
| 5         | Declined                 |
| 6         | Further Info Requested   |
| 7         | Pending                  |
| 8         | Registered               |

## Security Vulnerabilities

Please [e-mail security vulnerabilities directly to me](mailto:matt@mralston.co.uk).

## Licence

PDF is open-sourced software licenced under the [MIT license](LICENSE.md).
