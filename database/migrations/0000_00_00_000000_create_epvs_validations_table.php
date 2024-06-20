<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epvs_validations', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('created_by_user_id')->nullable()->index();
            $table->integer('assigned_to_user_id')->nullable()->index();
            $table->integer('installer_id')->nullable()->index();
            $table->integer('product_type_id')->nullable()->index();
            $table->string('customer_first_name')->nullable();
            $table->string('customer_last_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('installation_address_line_1')->nullable();
            $table->string('installation_address_line_2')->nullable();
            $table->string('installation_address_line_3')->nullable();
            $table->string('installation_area_town')->nullable();
            $table->string('installation_county')->nullable();
            $table->string('installation_postcode')->nullable();
            $table->integer('payment_method_id')->nullable()->index();
            $table->integer('finance_lender_id')->nullable()->index();
            $table->string('finance_reference')->nullable();
            $table->string('finance_term_length')->nullable();
            $table->integer('finance_broker_id')->nullable()->index();
            $table->integer('insurance_provider_id')->nullable()->index();
            $table->string('ibg_policy_number')->nullable();
            $table->string('sales_person_name')->nullable();
            $table->decimal('total_contract_value')->nullable();
            $table->decimal('deposit_paid')->nullable();
            $table->timestamp('date_contract_signed')->nullable();
            $table->timestamp('billed_date')->nullable();
            $table->integer('first_time_validation')->nullable();
            $table->integer('days_in_validation')->nullable();
            $table->boolean('missed_sla')->nullable();
            $table->integer('total_compliance_calls')->nullable();
            $table->integer('completed_compliance_call')->nullable();
            $table->integer('validation_status_id')->nullable()->index();
            $table->integer('number_days_to_validate')->nullable();
            $table->string('certificate_filename')->nullable();
            $table->integer('last_activity_by_user_id')->nullable()->index();
            $table->string('cancellation_reason')->nullable();
            $table->timestamp('cancellation_requested_at')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->string('last_activity_type')->nullable();
            $table->string('customer_full_name')->nullable();
            $table->string('installation_address_full')->nullable();
            $table->string('payment_method_readable')->nullable();
            $table->morphs('validationable');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epvs_validations');
    }
};