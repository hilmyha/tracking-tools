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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('renter_name');
            $table->string('renter_email');
            $table->timestamp('rental_date');
            $table->timestamp('due_date');
            $table->date('return_date')->nullable();
            $table->string('rental_status');
            $table->float('late_fee')->nullable();
            $table->float('total_cost')->nullable();
            $table->timestamps();
            
            $table->foreignId('tool_id')->constrained('tools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
