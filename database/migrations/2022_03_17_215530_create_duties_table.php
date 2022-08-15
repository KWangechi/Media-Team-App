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
            $table->string('member_name');
            $table->string('supervisor_name');
            $table->string('workstation');
            $table->text('duty_assigned');
            $table->string('type_of_service');
            $table->boolean('supervisor_signature')->default(0);
            $table->time('setup_time');
            $table->date('date_assigned');
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
