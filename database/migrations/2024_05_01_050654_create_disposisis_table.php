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
            Schema::create('dispositions', function (Blueprint $table) {
                $table->id();
                $table->dateTime('disposition_at');
                $table->date('reply_at');
                $table->text('description');
                $table->string('notification');
                $table->foreignId('ref_type_id')->constrained('mail_types');
                $table->foreignId('user_id')->constrained('users');
                $table->foreignId('mail_id')->constrained('mails');
                $table->enum('status', ['diverifikasi', 'menunggu verifikasi']) -> default('menunggu verifikasi');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
