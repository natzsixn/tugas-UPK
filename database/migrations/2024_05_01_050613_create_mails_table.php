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
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->dateTime('incoming_at');
            $table->string('mail_code');
            $table->date('mail_date');
            $table->string('mail_from');
            $table->string('mail_to');
            $table->string('mail_subject');
            $table->text('description');
            $table->foreignId('mail_type_id')->constrained('mail_types');
            $table->foreignId('user_id')->constrained('users');
            $table->string('file_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};
