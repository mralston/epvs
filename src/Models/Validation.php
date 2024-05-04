<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class Validation extends Model
{
    use HydratesRelations;

    protected $fillable = [
        'created_by_user_id',
        'assigned_to_user_id',
        'installer_id',
        'product_type_id',
        'customer_first_name',
        'customer_last_name',
        'customer_phone',
        'customer_email',
        'installation_address_line_1',
        'installation_address_line_2',
        'installation_address_line_3',
        'installation_area_town',
        'installation_county',
        'installation_postcode',
        'payment_method_id',
        'finance_lender_id',
        'finance_reference',
        'finance_term_length',
        'finance_broker_id',
        'insurance_provider_id',
        'ibg_policy_number',
        'sales_person_name',
        'total_contract_value',
        'deposit_paid',
        'date_contract_signed',
        'billed_date',
        'first_time_validation',
        'days_in_validation',
        'missed_sla',
        'total_compliance_calls',
        'completed_compliance_call',
        'validation_status_id',
        'number_days_to_validate',
        'certificate_filename',
        'last_activity_by_user_id',
        'cancellation_reason',
        'cancellation_requested_at',
        'last_activity_at',
        'last_activity_type',
        'deleted_at',
        'created_at',
        'updated_at',
        'customer_full_name',
        'installation_address_full',
        'payment_method_readable',
        'assigned_to_user',
        'created_by_user',
        'installer',
        'product_type',
        'finance_lender',
        'finance_broker',
        'insurance_provider',
        'validation_status',
    ];

    protected $hydrate = [
        'finance_lender' => FinanceLender::class,
        'installer' => Installer::class,
        'assigned_to_user' => User::class,
        'created_by_user' => User::class,
        'product_type' => ProductType::class,
        'finance_broker' => FinanceBroker::class,
        'insurance_provider' => InsuranceProvider::class,
        'validation_status' => ValidationStatus::class,
    ];
}