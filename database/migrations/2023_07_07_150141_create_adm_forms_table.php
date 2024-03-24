<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adm_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('to')->nullable();
            $table->string('subject')->nullable();
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->string('link_hash')->unique();
            $table->boolean('is_enabled')->default(true);
            $table->boolean('send_notify')->default(false);
            $table->json('fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_forms');
    }
};
