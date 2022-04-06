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
        Schema::create('attendee_event', function (Blueprint $table) {

            $table->foreignId('event_id')
                ->constrained()
                ->onUpdate('cascade');

            $table->foreignId('attendee_id')
                ->constrained()
                ->onUpdate('cascade');

            $table->primary(['event_id', 'attendee_id']);

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
        Schema::dropIfExists('attendee_event');
    }
};
