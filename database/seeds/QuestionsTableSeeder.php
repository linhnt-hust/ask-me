<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-03-26
 * Time: 14:48
 */

use Illuminate\Database\Seeder;
use App\Models as Database;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('questions')->truncate();

        $questions = [
            ['This is my first question', '0', 'Is Howard Starks Super Soldier Serum in civil WAR ultimately superior to the numerous versions that came before it?', '2', '8', '0'],
        ];

        foreach ($questions as $question) {
            Database\Question::create([
                'title' => $question[0],
                'question_poll' => $question[1],
                'details' => $question[2],
                'user_id' => $question[3],
                'category_id' => $question[4],
                'approve_status' => $question[5],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);

        }

        factory(App\Models\Question::class, 100)->create();

        Schema::enableForeignKeyConstraints();
    }
}
