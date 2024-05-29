<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_bills', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('month');
            $table->float('amount')->nullable();
            $table->float('paid')->nullable();
            $table->date('billing_date')->nullable();
            $table->float('pending')->nullable();
            $table->unsignedSmallInteger('package_id')->nullable();
            $table->boolean('is_deleted')->default(0);

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
        Schema::dropIfExists('customers_bills');
    }
}
