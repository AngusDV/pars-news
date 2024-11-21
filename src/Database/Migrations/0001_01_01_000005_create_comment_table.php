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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id'); // Assuming you have a users table
            $table->unsignedBigInteger('user_id'); // Assuming you have a users table
            $table->unsignedBigInteger('article_id'); // Assuming you have an articles table
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();
            // Foreign keys
            $table->foreign('creator_id')->references('id')->on('api_users')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);
            $table->dropForeign(['article_id']);
        });

        Schema::dropIfExists('comments');
    }
};
