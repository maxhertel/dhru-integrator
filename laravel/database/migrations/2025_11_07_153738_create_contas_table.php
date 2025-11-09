<?php
// database/migrations/2025_11_07_create_contas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasTable extends Migration
{
    public function up()
    {
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->string('ferramenta')->nullable(); // nome da ferramenta/serviço
            $table->string('usuario')->unique();
            $table->string('senha')->nullable(); // armazenar ENCRIPTADO (ver abaixo)
            $table->enum('status', ['disponivel','alugado','desativado'])->default('disponivel');
            $table->timestamp('ultima_atualizacao')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contas');
    }
}
