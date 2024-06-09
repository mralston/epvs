<?php

namespace Mralston\Epvs\Models;

use Illuminate\Database\Eloquent\Model;
use Mralston\Epvs\Traits\HydratesRelations;

class Validation extends Model
{
    use HydratesRelations;

    protected $table = 'epvs_validations';

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
    ];

    protected $casts = [
        'date_contract_signed' => 'datetime',
        'billed_date' => 'datetime',
        'cancellation_requested_at' => 'datetime',
        'last_activity_at' => 'datetime',
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

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function installer()
    {
        return $this->belongsTo(Installer::class);
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function financeLender()
    {
        return $this->belongsTo(FinanceLender::class);
    }

    public function financeBroker()
    {
        return $this->belongsTo(FinanceBroker::class);
    }

    public function insuranceProvider()
    {
        return $this->belongsTo(InsuranceProvider::class);
    }

    public function validationStatus()
    {
        return $this->belongsTo(ValidationStatus::class);
    }
}