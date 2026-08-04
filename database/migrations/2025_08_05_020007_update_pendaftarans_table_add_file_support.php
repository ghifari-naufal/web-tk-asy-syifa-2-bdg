<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            
            // Data Pendaftaran
            $table->string('nama_ortu');
            $table->string('no_hp', 20);
            $table->string('nama_anak');
            $table->enum('kelas_tk', ['TK A', 'TK B']);
            
            // Data File Upload
            $table->string('file_title')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable(); // pdf, image, word
            $table->integer('file_size')->nullable(); // dalam bytes

            // Dokumen Persyaratan (KK, Akta, KTP)
            $table->string('dokumen_persyaratan_title')->nullable();
            $table->string('dokumen_persyaratan_path')->nullable();
            $table->string('dokumen_persyaratan_type')->nullable();
            $table->integer('dokumen_persyaratan_size')->nullable();
            
            // Status dan Catatan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            // $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
            // $table->foreign('rejected_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};