<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'order_id' => '2505210001',
                'customer_id' => 1,
                'order_date' => '2025-05-21 22:53:56',
                'total_price' => '75.00',
                'status' => 1,
            ),
            1 => 
            array (
                'order_id' => '2505210002',
                'customer_id' => 2,
                'order_date' => '2025-05-21 22:53:56',
                'total_price' => '200.00',
                'status' => 1,
            ),
            2 => 
            array (
                'order_id' => '2505210003',
                'customer_id' => 3,
                'order_date' => '2025-05-21 22:53:56',
                'total_price' => '150.00',
                'status' => 2,
            ),
            3 => 
            array (
                'order_id' => '2505210004',
                'customer_id' => 4,
                'order_date' => '2025-05-21 22:53:56',
                'total_price' => '50.00',
                'status' => 1,
            ),
        ));
        
        
    }
}