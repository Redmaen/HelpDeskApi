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
        Schema::create('software_machines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_software')->nullable()->constrained('softwares')->nullOnDelete();
            $table->foreignId('id_machine')->nullable()->constrained('machines')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('software_machines');
    }
};
