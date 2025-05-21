<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'customer_id' => 1,
                'name' => 'Nguyen Van A',
                'email' => 'nguyenvana@example.com',
                'phone' => '0901234567',
                'address' => '123 Đường ABC, Quận 1, TP.HCM',
                'avatar' => '1.png',
                'gender' => 'male',
                'password' => 'hashedpassword1',
                'created_at' => '2025-05-21 21:45:19',
                'updated_at' => '2025-05-21 21:45:19',
            ),
            1 => 
            array (
                'customer_id' => 2,
                'name' => 'Tran Thi B',
                'email' => 'tranthib@example.com',
                'phone' => '0907654321',
                'address' => '456 Đường XYZ, Quận 2, TP.HCM',
                'avatar' => '2.png',
                'gender' => 'female',
                'password' => 'hashedpassword2',
                'created_at' => '2025-05-21 21:45:19',
                'updated_at' => '2025-05-21 21:45:19',
            ),
            2 => 
            array (
                'customer_id' => 3,
                'name' => 'Pham Minh C',
                'email' => 'phamminhc@example.com',
                'phone' => '0912345678',
                'address' => '789 Đường DEF, Quận 3, TP.HCM',
                'avatar' => '3.png',
                'gender' => 'male',
                'password' => 'hashedpassword3',
                'created_at' => '2025-05-21 21:45:19',
                'updated_at' => '2025-05-21 21:45:19',
            ),
            3 => 
            array (
                'customer_id' => 4,
                'name' => 'Le Thi D',
                'email' => 'lethid@example.com',
                'phone' => '0918765432',
                'address' => '101 Đường GHI, Quận 4, TP.HCM',
                'avatar' => '4.png',
                'gender' => 'female',
                'password' => 'hashedpassword4',
                'created_at' => '2025-05-21 21:45:19',
                'updated_at' => '2025-05-21 21:45:19',
            ),
        ));
        
        
    }
}