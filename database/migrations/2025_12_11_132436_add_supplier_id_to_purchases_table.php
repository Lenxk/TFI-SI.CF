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
    Schema::table('purchases', function (Blueprint $table) {
        $table->foreignId('supplier_id')->nullable()->after('id')->constrained()->nullOnDelete();
        $table->dropColumn('supplier');
    });
    }

public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
            $table->string('supplier')->nullable();
        });
    }

};
