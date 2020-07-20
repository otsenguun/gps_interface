<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->Longtext('data')->nullable();
            $table->string('imei',15)->nullable();
            $table->string('vehiclestatus',8)->default(0);
            $table->string('batvoltage',2)->default(0);
            $table->string('supvoltage',2)->default(0);
            $table->string('tempa',4)->default(0);
            $table->string('tempb',4)->default(0);
            $table->string('gpssatellites',2)->default(0);
            $table->string('gsmsignal',2)->default(0);
            $table->string('angle',3)->default(0);
            $table->string('speed',3)->default(0);
            $table->string('hdop',4)->default(0);
            $table->string('mileage',7)->default(0);
            $table->string('lat', 9)->default(0);
            $table->string('ns',1)->default(0);
            $table->string('lng', 10)->default(0);
            $table->string('ew', 1)->default(0);
            $table->string('serialnumber', 4)->default(0);      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
