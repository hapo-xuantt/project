<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->insert([
            'name' => 'xuan',
            'email' => 'xuan@gmail.com',
            'password' => '123456789',
            'is_admin' => '1',
            'account' => 'cc',
            'image' => 'jj',
        ]);
    }
}
