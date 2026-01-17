<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Pastikan Schema::create, BUKAN Schema::table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->string('image')->nullable();

            // --- INI GABUNGAN SEMUA KOLOM TAMBAHAN ---
            $table->string('code')->unique()->nullable();
            $table->string('group')->nullable(); // Kolom group masuk sini
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
