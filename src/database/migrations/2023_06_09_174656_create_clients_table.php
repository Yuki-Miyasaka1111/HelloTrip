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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('manager_name');
            $table->string('manager_department');
            $table->string('manager_phone_number');
            $table->string('email')->unique('clients_client_email_unique');
            $table->string('password');
            $table->timestamps();
            $table->rememberToken();
            $table->boolean('is_active')->default(false);
            $table->string('email_verification_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
