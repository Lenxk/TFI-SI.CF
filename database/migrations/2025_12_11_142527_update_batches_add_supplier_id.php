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
    Schema::table('product_batches', function (Blueprint $table) {
        $table->foreignId('supplier_id')
              ->after('product_id')
              ->constrained('suppliers')
              ->onDelete('cascade');
        
        $table->dropColumn('supplier'); // si existe
    });
}

public function down()
{
    Schema::table('product_batches', function (Blueprint $table) {
        $table->string('supplier')->nullable();
        $table->dropForeign(['supplier_id']);
        $table->dropColumn('supplier_id');
    });
}
};
