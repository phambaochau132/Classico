<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_details')->delete();
        
        \DB::table('order_details')->insert(array (
            0 => 
            array (
                'order_detail_id' => 1,
                'order_id' => '2505210001',
                'product_id' => 1,
                'quantity' => 2,
                'price' => '20.00',
            ),
            1 => 
            array (
                'order_detail_id' => 2,
                'order_id' => '2505210001',
                'product_id' => 3,
                'quantity' => 1,
                'price' => '55.00',
            ),
            2 => 
            array (
                'order_detail_id' => 3,
                'order_id' => '2505210002',
                'product_id' => 4,
                'quantity' => 2,
                'price' => '45.00',
            ),
            3 => 
            array (
                'order_detail_id' => 4,
                'order_id' => '2505210002',
                'product_id' => 5,
                'quantity' => 1,
                'price' => '60.00',
            ),
            4 => 
            array (
                'order_detail_id' => 5,
                'order_id' => '2505210003',
                'product_id' => 2,
                'quantity' => 1,
                'price' => '40.00',
            ),
            5 => 
            array (
                'order_detail_id' => 6,
                'order_id' => '2505210003',
                'product_id' => 3,
                'quantity' => 1,
                'price' => '55.00',
            ),
            6 => 
            array (
                'order_detail_id' => 7,
                'order_id' => '2505210004',
                'product_id' => 7,
                'quantity' => 1,
                'price' => '65.00',
            ),
        ));
        
        
    }
}