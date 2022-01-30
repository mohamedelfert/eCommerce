<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $data['name'] = 'Admin';
        $data['email'] = 'admin@yahoo.com';
        $data['password'] = Hash::make('123456');
        $data['created_at'] = date('Y-m-d H:m:s');
        $data['updated_at'] = date('Y-m-d H:m:s');

        DB::table('admins')->insert($data);
    }
}
