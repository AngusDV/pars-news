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
        Schema::create('article_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('article_id');
            $table->enum('like_dislike', ['like', 'dislike']); // 'like' or 'dislike'
            $table->timestamps();
            $table->softDeletes();
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['article_id']);
        });

        Schema::dropIfExists('article_likes');
    }
};
