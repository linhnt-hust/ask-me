<?php

use Illuminate\Database\Seeder;

class BlogsUploadedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('blog_uploaded')->truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Models\BlogUploaded::class, 100)->create();
    }
}
