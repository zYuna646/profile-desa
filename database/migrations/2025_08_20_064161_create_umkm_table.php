<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('umkm_categories')->onDelete('set null');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('owner');
            $table->text('description');
            $table->string('image')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('reviews')->default(0);
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkm');
    }
};