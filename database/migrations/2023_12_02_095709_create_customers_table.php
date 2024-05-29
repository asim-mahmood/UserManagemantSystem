<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('company_type')->nullable();
            $table->string('package_type')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('cnic')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('mobile_number2')->nullable();
            $table->string('email')->nullable();
            $table->float('price')->nullable();
            $table->float('installation_charges')->nullable();
            $table->float('device_charges')->nullable();
            $table->float('security')->nullable();
            $table->float('total_bill')->nullable();
            $table->string('company_name')->nullable();
            $table->date('billing_date')->nullable();
            $table->string('address')->nullable();
            $table->string('device_modal')->nullable();
            $table->string('purchasing')->nullable();
            $table->string('device_property')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(1);

            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
