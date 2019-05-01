<?php

use Illuminate\Database\Seeder;

class BlogsCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('blog_category')->truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Models\BlogCategory::class, 100)->create();
    }
}
