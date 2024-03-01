<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            $new_project = new Project;
            $new_project->name = $faker->words(3, true);
            $new_project->description = $faker->paragraph(3, true);
            $new_project->start_date = $faker->date();
            $new_project->end_date = $faker->date();
            $new_project->slug = Str::slug($new_project->name, '_');
            $new_project->save();
        }
    }
}
