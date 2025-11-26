<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title' => 'Home',
            'content' => 'Welcome to the home page!',
        ]);

        Page::create([
            'title' => 'About',
            'content' => 'This is the about page.',
        ]);

        Page::create([
            'title' => 'Contact',
            'content' => 'This is the contact page.',
        ]);
    }
}
