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
        Schema::table('penawarans', function (Blueprint $table) {
            $table->integer('barang_keluar')->nullable();
            $table->integer('barang_terjual')->nullable();
            $table->integer('barang_retur')->nullable();
            $table->string('total')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penawarans', function (Blueprint $table) {
            $table->dropColumn('barang_keluar');
            $table->dropColumn('barang_terjual');
            $table->dropColumn('barang_retur');
            $table->dropColumn('total');
        });
    }
};
