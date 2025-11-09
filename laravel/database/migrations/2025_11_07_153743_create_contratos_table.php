<?php

// database/migrations/2025_11_07_create_contratos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conta_id')->constrained('contas')->onDelete('cascade');
            $table->foreignId('cliente_id')->constrained('users')->onDelete('cascade'); // quem alugou
            $table->foreignId('fornecedor_id')->nullable()->constrained('users')->nullOnDelete(); // dono da conta/serviço, opcional
            $table->enum('status', ['pendente','ativo','finalizado','cancelado'])->default('pendente');
            $table->timestamp('inicio')->nullable();
            $table->timestamp('fim')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
