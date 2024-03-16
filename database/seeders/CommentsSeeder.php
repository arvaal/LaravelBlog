<?php

namespace Database\Seeders;

use App\Models\Blog\Comment;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            'user_id' => 2,
            'post_id' => 4,
            'comment' => 'comment text',
            'status' => 1,
        ]);
    }
}
