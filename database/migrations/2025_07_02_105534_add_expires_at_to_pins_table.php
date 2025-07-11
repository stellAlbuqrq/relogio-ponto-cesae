<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pin', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable()->after('created_at');
        });
    }

    public function down()
    {
        Schema::table('pin', function (Blueprint $table) {
            $table->dropColumn('expires_at');
        });
    }
};
