<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=> bcrypt('admin123'),
            'is_admin' => 1,
        ]);

        // User ini admin
        User::create([
            'name' => 'bukanadmin',
            'email' => 'bukan@admin.com',
            'password'=> bcrypt('bukan123'),
            'is_admin' => 1,
        ]);

        Category::create([
            'name' => 'Programming',
            'user_id' => 1
        ]);

        Category::create([
            'name' => 'Web design',
            'user_id' => 1
        ]);

        Category::create([
            'name' => 'Personal',
            'user_id' => 1
        ]);

        Category::create([
            'name' => 'News',
            'user_id' => 2
        ]);

        User::factory(3)->create();
        Article::factory(14)->create();

    }
}
