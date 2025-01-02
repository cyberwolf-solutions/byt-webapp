<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('customer')->nullable();
            $table->text('lecturer')->nullable();
            $table->dateTime('start');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->dateTime('end')->nullable();
            $table->softDeletes(); // Add soft deletes column
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
