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
        Schema::create('duties', function (Blueprint $table) {
            $table->id();
            $table->string('week')->nullable();
            $table->date('date_assigned')->nullable();
            $table->boolean('supervisor_signature')->default(0)->nullable();
            $table->time('setup_time')->nullable();
            $table->timestamps();

            // $table->foreignId('equipment_id')->constrained('equipment');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duties');
    }
};
