<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_link_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone');
            $table->unique(['collection_link_id', 'phone']); // Un numéro unique par lien
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
