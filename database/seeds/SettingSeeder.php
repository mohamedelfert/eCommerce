<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $data['sitename_ar'] = 'سيستم تجاري';
        $data['sitename_en'] = 'E-Commerce System';
        $data['logo'] = 'logo';
        $data['icon'] = 'icon';
        $data['email'] = 'info@ecommerce.com';
        $data['main_lang'] = 'ar';
        $data['description'] = 'This Is E-Commerce System';
        $data['keywords'] = 'ecommerce,shop,system';
        $data['status'] = 'open';
        $data['message_maintenance'] = 'Now Site In Maintenance Try Again Later';

        DB::table('settings')->insert($data);
    }
}
