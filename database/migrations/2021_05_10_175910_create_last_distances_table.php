<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLastDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_distances', function (Blueprint $table) {
            $table->id();
            $table->Longtext('data')->nullable();
            $table->string('imei',15)->nullable();
 	        $table->dateTime('datetime')->nullable();
            $table->string('angle',3)->default(0);
            $table->string('speed',3)->default(0);
            $table->string('lat', 9)->default(0);
            $table->string('lng', 10)->default(0);
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
        Schema::dropIfExists('last_distances');
    }
}
