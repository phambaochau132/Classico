<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SystemUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('system_users')->delete();
        
        
        
    }
}