<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->renameColumn('region_id', 'id');
            $table->renameColumn('region_name', 'name');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->string('slug')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regions', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('regions', function (Blueprint $table) {
            $table->renameColumn('id', 'region_id');
            $table->renameColumn('name', 'region_name');
        });
    }
};