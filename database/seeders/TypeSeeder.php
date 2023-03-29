<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Model
use App\Models\Type;
// Helpers
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'fragola',
            'ciliegia',
            'cocomero',
            'melone',
            'pesca',
            'mela',
            'percoca'
        ];

        foreach ($types as $type) {
            $newTypes = Type::create([
                'name' => $type,
                'slug' => Str::slug($type)
            ]);
        }
    }
}
