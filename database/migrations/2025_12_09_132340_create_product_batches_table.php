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
    Schema::create('product_batches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
        $table->string('supplier')->nullable();          // proveedor
        $table->string('lot_code')->nullable();          // opcional: código de lote
        $table->integer('quantity');                     // cantidad en este lote
        $table->date('expires_at')->nullable();          // fecha de vencimiento
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_batches');
    }
};
