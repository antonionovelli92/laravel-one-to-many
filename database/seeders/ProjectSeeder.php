<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // $max = Category::count();
        $category_ids = Category::select('id')->pluck('id')->toArray();
        $category_ids[] = null;
        for ($i = 0; $i < 5; $i++) {
            $project = new Project();


            $project->category_id = Arr::random($category_ids);
            $project->title = $faker->text(20);
            $project->author = $faker->name();
            $project->description = $faker->sentence();
            $project->content = $faker->paragraphs(30, true);
            $project->slug = Str::slug($project->title, '_');
            // $project->image = $faker->imageUrl(350, 350);
            $project->url_project = $faker->text(250);
            $project->url_generic = $faker->text(250);
            $project->is_published = $faker->boolean();







            $project->save();
        }
    }
}
