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
    Schema::create('evaluations', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('evaluator_id');
        $table->unsignedBigInteger('project_id');
        $table->boolean('is_evaluated');
        $table->integer('score');
        $table->timestamps();

        $table->foreign('evaluator_id')->references('id')->on('users');
        $table->foreign('project_id')->references('id')->on('projects');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
