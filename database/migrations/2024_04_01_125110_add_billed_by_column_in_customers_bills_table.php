<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBilledByColumnInCustomersBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers_bills', function (Blueprint $table) {
            $table->string('billed_by')->default('Admin')->after('package_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers_bills', function (Blueprint $table) {
            $table->dropColumn('billed_by');
        });
    }
}
