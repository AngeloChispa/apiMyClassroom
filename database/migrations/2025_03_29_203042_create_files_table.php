<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('originalName', 255);
            $table->string('newName',512);
            $table->string('path', 512);
            $table->unsignedBigInteger('notice_id')->nullable();
            $table->foreign('notice_id')->references('id')->on('notices');

            $table->unsignedBigInteger('resource_id')->nullable();
            $table->foreign('resource_id')->references('id')->on('resources');
            
            $table->unsignedBigInteger('send_id')->nullable();
            $table->foreign('send_id')->references('id')->on('assignment_user');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
