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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('emp_d')->nullable();
            $table->string('leave_name')->nullable();
            $table->longText('leave_reason')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};