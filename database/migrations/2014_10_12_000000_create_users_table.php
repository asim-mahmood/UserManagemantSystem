<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('access_key')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('rold_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('last_login')->nullable();
            $table->string('last_ip')->nullable();
            $table->string('password');
            $table->string('readable_password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
