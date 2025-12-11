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
    Schema::create('customer_sales', function (Blueprint $table) {
        $table->id();
        $table->date('sale_date');
        $table->decimal('total', 10, 2)->default(0);
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('customer_sales');
}
};
