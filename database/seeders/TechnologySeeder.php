<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            'html',
            'css',
            'javascript',
            'vue',
            'bootstrap',
            'php',
            'laravel'
        ];

        foreach ($technologies as $technology) {
            $newTechnology = Technology::create([
                'name' => $technology,
                'slug' => Str::slug($technology)
            ]);
        }
    }
}
