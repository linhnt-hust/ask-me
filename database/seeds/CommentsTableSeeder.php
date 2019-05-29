<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('comments')->truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Models\Comment::class, 250)->create();
    }
}
