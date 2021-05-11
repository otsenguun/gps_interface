<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('devices', function($table) {
            $table->integer('org_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('status')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('app_driver')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
