<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Crea la tabla task_logs
    public function up(): void
    {
        Schema::create('task_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade');
            $table->string('action', 50);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    // Elimina la tabla task_logs
    public function down(): void
    {
        Schema::dropIfExists('task_logs');
    }
};
