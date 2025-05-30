<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payments')->delete();
        
        \DB::table('payments')->insert(array (
            0 => 
            array (
                'payment_id' => 1,
                'order_id' => '2505210001',
                'payment_method' => 1,
                'payment_status' => 0,
            ),
            1 => 
            array (
                'payment_id' => 2,
                'order_id' => '2505210002',
                'payment_method' => 0,
                'payment_status' => 1,
            ),
            2 => 
            array (
                'payment_id' => 3,
                'order_id' => '2505210003',
                'payment_method' => 0,
                'payment_status' => 1,
            ),
            3 => 
            array (
                'payment_id' => 4,
                'order_id' => '2505210004',
                'payment_method' => 1,
                'payment_status' => 0,
            ),
        ));
        
        
    }
}