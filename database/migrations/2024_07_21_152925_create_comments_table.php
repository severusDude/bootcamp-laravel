<?php

use App\Models\News;
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
            $table->unsignedBigInteger('comment_id');
            $table->unsignedBigInteger('news_id');
            $table->primary(['comment_id', 'news_id']);
            $table->foreign('news_id')->references('news_id')->on('news')->cascadeOnDelete();
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->timestamps();
            $table->text('content');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
