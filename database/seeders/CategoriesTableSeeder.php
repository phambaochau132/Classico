<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'category_id' => 1,
                'category_name' => 'Áo Thun',
            ),
            1 => 
            array (
                'category_id' => 2,
                'category_name' => 'Quần Jean',
            ),
            2 => 
            array (
                'category_id' => 3,
                'category_name' => 'Giày Thể Thao',
            ),
            3 => 
            array (
                'category_id' => 4,
                'category_name' => 'Váy Đầm',
            ),
            4 => 
            array (
                'category_id' => 5,
                'category_name' => 'Túi Xách',
            ),
            5 => 
            array (
                'category_id' => 6,
                'category_name' => 'Phụ Kiện Thời Trang',
            ),
            6 => 
            array (
                'category_id' => 7,
                'category_name' => 'Áo Khoác',
            ),
            7 => 
            array (
                'category_id' => 8,
                'category_name' => 'Dép Sandal',
            ),
            8 => 
            array (
                'category_id' => 9,
                'category_name' => 'Áo Thun',
            ),
            9 => 
            array (
                'category_id' => 10,
                'category_name' => 'Quần Jean',
            ),
            10 => 
            array (
                'category_id' => 11,
                'category_name' => 'Giày Thể Thao',
            ),
            11 => 
            array (
                'category_id' => 12,
                'category_name' => 'Váy Đầm',
            ),
            12 => 
            array (
                'category_id' => 13,
                'category_name' => 'Túi Xách',
            ),
            13 => 
            array (
                'category_id' => 14,
                'category_name' => 'Phụ Kiện Thời Trang',
            ),
            14 => 
            array (
                'category_id' => 15,
                'category_name' => 'Áo Khoác',
            ),
            15 => 
            array (
                'category_id' => 16,
                'category_name' => 'Dép Sandal',
            ),
            16 => 
            array (
                'category_id' => 17,
                'category_name' => 'Áo Thun',
            ),
            17 => 
            array (
                'category_id' => 18,
                'category_name' => 'Quần Jean',
            ),
            18 => 
            array (
                'category_id' => 19,
                'category_name' => 'Giày Thể Thao',
            ),
            19 => 
            array (
                'category_id' => 20,
                'category_name' => 'Váy Đầm',
            ),
            20 => 
            array (
                'category_id' => 21,
                'category_name' => 'Túi Xách',
            ),
            21 => 
            array (
                'category_id' => 22,
                'category_name' => 'Phụ Kiện Thời Trang',
            ),
            22 => 
            array (
                'category_id' => 23,
                'category_name' => 'Áo Khoác',
            ),
            23 => 
            array (
                'category_id' => 24,
                'category_name' => 'Dép Sandal',
            ),
        ));
        
        
    }
}