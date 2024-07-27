<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{

    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'news_id' => News::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'content' => fake()->text(),
        ];
    }
}
