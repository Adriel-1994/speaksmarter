<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('lessons', function (Blueprint $table) {
            $table->text('image_uri')->nullable(true)->change();
            $table->text('content_uri')->nullable(true)->change();
            $table->text('pdf_uri')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('lessons', function (Blueprint $table) {
            $table->text('image_uri')->nullable(false)->change();
            $table->text('content_uri')->nullable(false)->change();
            $table->text('pdf_uri')->nullable(false)->change();
        });
    }
};
