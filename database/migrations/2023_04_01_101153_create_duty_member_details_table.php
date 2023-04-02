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
        Schema::create('duty_member_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('duty_id')->nullable();
            $table->string('member_name')->nullable();
            $table->string('supervisor_name')->nullable();
            $table->string('workstation')->nullable();
            $table->text('duty_assigned')->nullable();
            $table->string('event_type')->nullable();
            $table->timestamps();

            //foreign key for the duty id
            $table->foreign('duty_id')->references('id')->on('duties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duty_member_details');
    }
};
