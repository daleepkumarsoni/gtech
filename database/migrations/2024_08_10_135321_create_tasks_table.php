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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects');
            $table->string('name');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'completed']);
            $table->foreignId('assigned_to')->constrained('users');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->date('due_date');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
