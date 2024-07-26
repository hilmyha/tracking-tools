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
        Schema::create('calibrates', function (Blueprint $table) {
            $table->id();
            $table->timestamp('calibration_date');
            $table->timestamp('calibration_due_date');
            $table->string('calibration_status');
            $table->timestamps();

            $table->foreignId('tool_id')->constrained('tools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calibrates');
    }
};
