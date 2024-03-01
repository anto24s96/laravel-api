<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['HTML', 'CSS', 'Javascript', 'Vuejs', 'PHP', 'Laravel'];

        foreach ($array as $element) {
            $new_technology = new Technology();
            $new_technology->name = $element;
            $new_technology->slug = Str::slug($element, '-');

            $new_technology->save();
        }
    }
}
