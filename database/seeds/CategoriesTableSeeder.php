<?php

use Illuminate\Database\Seeder;
use App\Models as Database;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();

        $listCategories = [
            'Technology',
            'Science',
            'Movies',
            'Music',
            'Health',
            'Food',
            'Books',
            'Visiting and Travel',
            'Business',
            'Psychology',
            'History',
            'Cooking',
            'Photography',
            'Sports',
            'Design',
            'Fashion and Style',
            'Writing',
            'Economics',
            'Mathematics',
            'Philosophy',
            'Politics',
            'Finance',
            'Marketing',
            'Television Series',
            'Art',
            'Literature',
            'Journalist',
            'Education',
        ];

        foreach ($listCategories as $category) {
            Database\Category::create([
                'name_category' => $category
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
