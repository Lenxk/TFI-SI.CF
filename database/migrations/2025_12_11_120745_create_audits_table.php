<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('audits', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('action'); // created, updated, deleted
        $table->string('model');  // Product, Sale, Purchase, Category
        $table->unsignedBigInteger('model_id'); // ID del registro afectado

        $table->json('changes')->nullable(); // campos modificados
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('audits');
    }
};
