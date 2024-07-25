<?php

use App\Models\News;
use App\Models\User;
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
            $table->unsignedBigInteger('id');
            $table->foreignIdFor(News::class);
            $table->foreignIdFor(User::class);
            $table->timestamps();
            $table->text('content');
            $table->softDeletes();

            $table->unique(['news_id', 'id']);
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
