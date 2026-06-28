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
        Schema::create('testimonials', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('avatar')->nullable(); // آدرس عکس پروفایل
			$table->tinyInteger('rating')->unsigned(); // 1 تا 5
			$table->text('comment');
			$table->text('reply')->nullable(); // پاسخ ادمین
			$table->boolean('is_approved')->default(false);
			$table->boolean('is_featured')->default(false); // برای نظرات ویژه
			$table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
