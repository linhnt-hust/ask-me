<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-03-26
 * Time: 11:12
 */

use Illuminate\Database\Seeder;
use App\Models as Database;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();

        $users = [
            ['rin', 'linhnt.dev.hust@gmail.com', '111111', 'truong dinh, ha noi', 'rinrucro.com', 'vietnam', 'users.png','Vì Tổ Quốc Xã Hội Chủ Nghĩa. Vì lý tưởng của bác Hồ vĩ đại. Sẵn sàng'],
        ];

        foreach ($users as $user) {
            Database\User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'address' => $user[3],
                'website' => $user[4],
                'country' => $user[5],
                'avatar' => $user[6],
                'description' => $user[7],
            ]);

        }

        factory(App\Models\User::class, 20)->create();

        Schema::enableForeignKeyConstraints();
    }
}
