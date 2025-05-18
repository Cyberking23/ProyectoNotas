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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp('remind_at'); // Cambiado de fecha_recordatorio a remind_at
            $table->boolean('activo');
            $table->boolean('sent')->default(false);
            $table->foreignId("note_id")->constrained("notes")->onDelete("cascade"); // Cambiado de id_note a note_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
