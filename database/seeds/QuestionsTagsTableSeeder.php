<?php

use Illuminate\Database\Seeder;

class QuestionsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('question_tag')->truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Models\QuestionTag::class, 80)->create();
    }
}
