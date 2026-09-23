<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Thread::factory(10)
            ->has(Post::factory()->count(5))
            ->create();
    }
}
