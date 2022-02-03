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

        $data['sitename_ar'] = 'نسيم - مستحضرات تجميل';
        $data['sitename_en'] = 'Naseem Cosmetics';
        $data['logo'] = 'logo';
        $data['icon'] = 'icon';
        $data['email'] = 'info@ecommerce.com';
        $data['main_lang'] = 'ar';
        $data['description'] = 'Naseem Cosmetics For All Cosmetics You Want';
        $data['keywords'] = 'ecommerce,shop,system,naseem,cosmetics,cosmetic';
        $data['status'] = 'open';
        $data['message_maintenance'] = 'Now Site In Maintenance Try Again Later';

        DB::table('settings')->insert($data);
    }
}
