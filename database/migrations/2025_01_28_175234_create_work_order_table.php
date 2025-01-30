<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_order', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('location');
            $table->enum('priority', ['baixa', 'média', 'alta'])->default('baixa');
            $table->string('category');
            $table->enum('status', ['aberta', 'em_andamento', 'finalizada', 'cancelada'])->default('aberta');
            $table->text('feedback')->nullable();
            $table->tinyInteger('feedback_note')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_order');
    }
};
