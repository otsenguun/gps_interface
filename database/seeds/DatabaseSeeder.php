<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
            'name' => 'Master',
            'email' => 'master@admin.mn',
            'password' => Hash::make('123456'),
            'type' => 9
        ]);
    }
}
