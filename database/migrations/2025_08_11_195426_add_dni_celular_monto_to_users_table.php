<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Primero agregamos las columnas sin la restricción unique
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni', 8)->nullable(); // Temporalmente nullable
            $table->string('celular', 9)->nullable(); // Temporalmente nullable
            $table->decimal('monto_aportado', 10, 2)->default(0.00);
        });

        // Asignamos valores temporales únicos a los DNIs existentes
        DB::table('users')->whereNull('dni')->update([
            'dni' => DB::raw("CONCAT('TEMP_', id)") // Valor temporal único
        ]);

        // Ahora modificamos las columnas para hacerlas no nulas y únicas
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni', 8)->nullable(false)->unique()->change();
            $table->string('celular', 9)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dni', 'celular', 'monto_aportado']);
        });
    }
};