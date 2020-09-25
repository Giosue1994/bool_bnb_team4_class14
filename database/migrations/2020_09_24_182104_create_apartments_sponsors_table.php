<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsSponsorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments_sponsors', function (Blueprint $table) {
            $table->id();

            // apartment_id
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments');

            //sponsor_id
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
            ->references('id')
            ->on('sponsors');

            $table->date('inizio_sponsorizzazione');
            $table->date('fine_sponsorizzazione');
            $table->string('status_payment');

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
        Schema::dropIfExists('apartments_sponsors');
    }
}
