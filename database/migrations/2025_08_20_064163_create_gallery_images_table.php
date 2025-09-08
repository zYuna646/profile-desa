<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->text('caption')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Migrasi data dari kolom image di tabel galleries ke gallery_images
        $galleries = DB::table('galleries')->get();
        foreach ($galleries as $gallery) {
            if ($gallery->image) {
                DB::table('gallery_images')->insert([
                    'gallery_id' => $gallery->id,
                    'image' => $gallery->image,
                    'order' => 0,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // Hapus kolom image dari tabel galleries
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        // Tambahkan kembali kolom image ke tabel galleries
        Schema::table('galleries', function (Blueprint $table) {
            $table->string('image')->after('description');
        });

        // Migrasi balik data dari gallery_images ke galleries
        $galleryImages = DB::table('gallery_images')
            ->where('order', 0)
            ->get();

        foreach ($galleryImages as $image) {
            DB::table('galleries')
                ->where('id', $image->gallery_id)
                ->update(['image' => $image->image]);
        }

        Schema::dropIfExists('gallery_images');
    }
};