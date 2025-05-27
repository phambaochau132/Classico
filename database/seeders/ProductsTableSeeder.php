<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'product_name' => 'Áo Thun Nam',
                'product_photo' => 'ao_thun_nam.jpg',
                'product_description' => 'Áo thun nam cổ tròn, chất liệu cotton mềm mại',
                'price' => '20.00',
                'stock_quantity' => 100,
                'category_id' => 1,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:43:09',
            ),
            1 => 
            array (
                'product_id' => 2,
                'product_name' => 'Áo Thun Nữ',
                'product_photo' => 'ao_thun_nu.jpg',
                'product_description' => 'Áo thun nữ dáng ôm, dễ dàng phối đồ',
                'price' => '18.00',
                'stock_quantity' => 80,
                'category_id' => 1,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:43:09',
            ),
            2 => 
            array (
                'product_id' => 3,
                'product_name' => 'Quần Jean Nam',
                'product_photo' => 'quan_jean_nam.jpg',
                'product_description' => 'Quần jean nam kiểu dáng slim fit',
                'price' => '40.00',
                'stock_quantity' => 120,
                'category_id' => 2,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:43:09',
            ),
            3 => 
            array (
                'product_id' => 4,
                'product_name' => 'Quần Jean Nữ',
                'product_photo' => 'quan_jean_nu.jpg',
                'product_description' => 'Quần jean nữ ống rộng, thời trang',
                'price' => '35.00',
                'stock_quantity' => 90,
                'category_id' => 2,
                'product_view' => 170,
                'create_at' => '2025-05-21 21:43:09',
            ),
            4 => 
            array (
                'product_id' => 5,
                'product_name' => 'Giày Thể Thao Nam',
                'product_photo' => 'giay_the_thao_nam.jpg',
                'product_description' => 'Giày thể thao nam, chất liệu da, bền và thoải mái',
                'price' => '55.00',
                'stock_quantity' => 150,
                'category_id' => 3,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:43:09',
            ),
            5 => 
            array (
                'product_id' => 6,
                'product_name' => 'Giày Thể Thao Nữ',
                'product_photo' => 'giay_the_thao_nu.jpg',
                'product_description' => 'Giày thể thao nữ, phong cách năng động, thoáng khí',
                'price' => '50.00',
                'stock_quantity' => 100,
                'category_id' => 3,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:43:09',
            ),
            6 => 
            array (
                'product_id' => 7,
                'product_name' => 'Váy Đầm Công Sở',
                'product_photo' => 'vay_dam_cong_so.jpg',
                'product_description' => 'Váy đầm công sở nữ, sang trọng và thanh lịch',
                'price' => '45.00',
                'stock_quantity' => 60,
                'category_id' => 4,
                'product_view' => 100,
                'create_at' => '2025-05-21 21:43:09',
            ),
            7 => 
            array (
                'product_id' => 8,
                'product_name' => 'Váy Đầm Dạ Hội',
                'product_photo' => 'vay_dam_da_hoi.jpg',
                'product_description' => 'Váy đầm dạ hội cao cấp, thiết kế tinh tế',
                'price' => '120.00',
                'stock_quantity' => 30,
                'category_id' => 4,
                'product_view' => 50,
                'create_at' => '2025-05-21 21:43:09',
            ),
            8 => 
            array (
                'product_id' => 9,
                'product_name' => 'Túi Xách Nữ',
                'product_photo' => 'tui_xach_nu.jpg',
                'product_description' => 'Túi xách nữ kiểu dáng thời trang, chất liệu da',
                'price' => '60.00',
                'stock_quantity' => 80,
                'category_id' => 5,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:43:09',
            ),
            9 => 
            array (
                'product_id' => 10,
                'product_name' => 'Túi Xách Nam',
                'product_photo' => 'tui_xach_nam.jpg',
                'product_description' => 'Túi xách nam đa năng, phong cách lịch lãm',
                'price' => '70.00',
                'stock_quantity' => 60,
                'category_id' => 5,
                'product_view' => 120,
                'create_at' => '2025-05-21 21:43:09',
            ),
            10 => 
            array (
                'product_id' => 11,
                'product_name' => 'Mũ Lưỡi Trai',
                'product_photo' => 'mu_luoi_trai.jpg',
                'product_description' => 'Mũ lưỡi trai nam nữ, phong cách trẻ trung',
                'price' => '15.00',
                'stock_quantity' => 200,
                'category_id' => 6,
                'product_view' => 300,
                'create_at' => '2025-05-21 21:43:09',
            ),
            11 => 
            array (
                'product_id' => 12,
                'product_name' => 'Kính Mát Nữ',
                'product_photo' => 'kinh_mat_nu.jpg',
                'product_description' => 'Kính mát nữ thời trang, bảo vệ mắt khỏi tia UV',
                'price' => '25.00',
                'stock_quantity' => 120,
                'category_id' => 6,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:43:09',
            ),
            12 => 
            array (
                'product_id' => 13,
                'product_name' => 'Áo Khoác Nam',
                'product_photo' => 'ao_khoac_nam.jpg',
                'product_description' => 'Áo khoác nam dày dặn, bảo vệ tốt trong mùa đông',
                'price' => '75.00',
                'stock_quantity' => 70,
                'category_id' => 7,
                'product_view' => 110,
                'create_at' => '2025-05-21 21:43:09',
            ),
            13 => 
            array (
                'product_id' => 14,
                'product_name' => 'Áo Khoác Nữ',
                'product_photo' => 'ao_khoac_nu.jpg',
                'product_description' => 'Áo khoác nữ kiểu dáng thanh lịch, ấm áp',
                'price' => '65.00',
                'stock_quantity' => 50,
                'category_id' => 7,
                'product_view' => 90,
                'create_at' => '2025-05-21 21:43:09',
            ),
            14 => 
            array (
                'product_id' => 15,
                'product_name' => 'Dép Sandal Nam',
                'product_photo' => 'dep_sandal_nam.jpg',
                'product_description' => 'Dép sandal nam, chất liệu da, phong cách đơn giản',
                'price' => '30.00',
                'stock_quantity' => 100,
                'category_id' => 8,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:43:09',
            ),
            15 => 
            array (
                'product_id' => 16,
                'product_name' => 'Dép Sandal Nữ',
                'product_photo' => 'dep_sandal_nu.jpg',
                'product_description' => 'Dép sandal nữ, nhẹ nhàng và thoải mái',
                'price' => '28.00',
                'stock_quantity' => 120,
                'category_id' => 8,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:43:09',
            ),
            16 => 
            array (
                'product_id' => 17,
                'product_name' => 'Áo Thun Nam',
                'product_photo' => 'ao_thun_nam.jpg',
                'product_description' => 'Áo thun nam cổ tròn, chất liệu cotton mềm mại',
                'price' => '20.00',
                'stock_quantity' => 100,
                'category_id' => 1,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:45:19',
            ),
            17 => 
            array (
                'product_id' => 18,
                'product_name' => 'Áo Thun Nữ',
                'product_photo' => 'ao_thun_nu.jpg',
                'product_description' => 'Áo thun nữ dáng ôm, dễ dàng phối đồ',
                'price' => '18.00',
                'stock_quantity' => 80,
                'category_id' => 1,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:19',
            ),
            18 => 
            array (
                'product_id' => 19,
                'product_name' => 'Quần Jean Nam',
                'product_photo' => 'quan_jean_nam.jpg',
                'product_description' => 'Quần jean nam kiểu dáng slim fit',
                'price' => '40.00',
                'stock_quantity' => 120,
                'category_id' => 2,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:45:19',
            ),
            19 => 
            array (
                'product_id' => 20,
                'product_name' => 'Quần Jean Nữ',
                'product_photo' => 'quan_jean_nu.jpg',
                'product_description' => 'Quần jean nữ ống rộng, thời trang',
                'price' => '35.00',
                'stock_quantity' => 90,
                'category_id' => 2,
                'product_view' => 170,
                'create_at' => '2025-05-21 21:45:19',
            ),
            20 => 
            array (
                'product_id' => 21,
                'product_name' => 'Giày Thể Thao Nam',
                'product_photo' => 'giay_the_thao_nam.jpg',
                'product_description' => 'Giày thể thao nam, chất liệu da, bền và thoải mái',
                'price' => '55.00',
                'stock_quantity' => 150,
                'category_id' => 3,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:45:19',
            ),
            21 => 
            array (
                'product_id' => 22,
                'product_name' => 'Giày Thể Thao Nữ',
                'product_photo' => 'giay_the_thao_nu.jpg',
                'product_description' => 'Giày thể thao nữ, phong cách năng động, thoáng khí',
                'price' => '50.00',
                'stock_quantity' => 100,
                'category_id' => 3,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:45:19',
            ),
            22 => 
            array (
                'product_id' => 23,
                'product_name' => 'Váy Đầm Công Sở',
                'product_photo' => 'vay_dam_cong_so.jpg',
                'product_description' => 'Váy đầm công sở nữ, sang trọng và thanh lịch',
                'price' => '45.00',
                'stock_quantity' => 60,
                'category_id' => 4,
                'product_view' => 100,
                'create_at' => '2025-05-21 21:45:19',
            ),
            23 => 
            array (
                'product_id' => 24,
                'product_name' => 'Váy Đầm Dạ Hội',
                'product_photo' => 'vay_dam_da_hoi.jpg',
                'product_description' => 'Váy đầm dạ hội cao cấp, thiết kế tinh tế',
                'price' => '120.00',
                'stock_quantity' => 30,
                'category_id' => 4,
                'product_view' => 50,
                'create_at' => '2025-05-21 21:45:19',
            ),
            24 => 
            array (
                'product_id' => 25,
                'product_name' => 'Túi Xách Nữ',
                'product_photo' => 'tui_xach_nu.jpg',
                'product_description' => 'Túi xách nữ kiểu dáng thời trang, chất liệu da',
                'price' => '60.00',
                'stock_quantity' => 80,
                'category_id' => 5,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:19',
            ),
            25 => 
            array (
                'product_id' => 26,
                'product_name' => 'Túi Xách Nam',
                'product_photo' => 'tui_xach_nam.jpg',
                'product_description' => 'Túi xách nam đa năng, phong cách lịch lãm',
                'price' => '70.00',
                'stock_quantity' => 60,
                'category_id' => 5,
                'product_view' => 120,
                'create_at' => '2025-05-21 21:45:19',
            ),
            26 => 
            array (
                'product_id' => 27,
                'product_name' => 'Mũ Lưỡi Trai',
                'product_photo' => 'mu_luoi_trai.jpg',
                'product_description' => 'Mũ lưỡi trai nam nữ, phong cách trẻ trung',
                'price' => '15.00',
                'stock_quantity' => 200,
                'category_id' => 6,
                'product_view' => 300,
                'create_at' => '2025-05-21 21:45:19',
            ),
            27 => 
            array (
                'product_id' => 28,
                'product_name' => 'Kính Mát Nữ',
                'product_photo' => 'kinh_mat_nu.jpg',
                'product_description' => 'Kính mát nữ thời trang, bảo vệ mắt khỏi tia UV',
                'price' => '25.00',
                'stock_quantity' => 120,
                'category_id' => 6,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:45:19',
            ),
            28 => 
            array (
                'product_id' => 29,
                'product_name' => 'Áo Khoác Nam',
                'product_photo' => 'ao_khoac_nam.jpg',
                'product_description' => 'Áo khoác nam dày dặn, bảo vệ tốt trong mùa đông',
                'price' => '75.00',
                'stock_quantity' => 70,
                'category_id' => 7,
                'product_view' => 110,
                'create_at' => '2025-05-21 21:45:19',
            ),
            29 => 
            array (
                'product_id' => 30,
                'product_name' => 'Áo Khoác Nữ',
                'product_photo' => 'ao_khoac_nu.jpg',
                'product_description' => 'Áo khoác nữ kiểu dáng thanh lịch, ấm áp',
                'price' => '65.00',
                'stock_quantity' => 50,
                'category_id' => 7,
                'product_view' => 90,
                'create_at' => '2025-05-21 21:45:19',
            ),
            30 => 
            array (
                'product_id' => 31,
                'product_name' => 'Dép Sandal Nam',
                'product_photo' => 'dep_sandal_nam.jpg',
                'product_description' => 'Dép sandal nam, chất liệu da, phong cách đơn giản',
                'price' => '30.00',
                'stock_quantity' => 100,
                'category_id' => 8,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:19',
            ),
            31 => 
            array (
                'product_id' => 32,
                'product_name' => 'Dép Sandal Nữ',
                'product_photo' => 'dep_sandal_nu.jpg',
                'product_description' => 'Dép sandal nữ, nhẹ nhàng và thoải mái',
                'price' => '28.00',
                'stock_quantity' => 120,
                'category_id' => 8,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:45:19',
            ),
            32 => 
            array (
                'product_id' => 33,
                'product_name' => 'Áo Thun Nam',
                'product_photo' => 'ao_thun_nam.jpg',
                'product_description' => 'Áo thun nam cổ tròn, chất liệu cotton mềm mại',
                'price' => '20.00',
                'stock_quantity' => 100,
                'category_id' => 1,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:45:49',
            ),
            33 => 
            array (
                'product_id' => 34,
                'product_name' => 'Áo Thun Nữ',
                'product_photo' => 'ao_thun_nu.jpg',
                'product_description' => 'Áo thun nữ dáng ôm, dễ dàng phối đồ',
                'price' => '18.00',
                'stock_quantity' => 80,
                'category_id' => 1,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:49',
            ),
            34 => 
            array (
                'product_id' => 35,
                'product_name' => 'Quần Jean Nam',
                'product_photo' => 'quan_jean_nam.jpg',
                'product_description' => 'Quần jean nam kiểu dáng slim fit',
                'price' => '40.00',
                'stock_quantity' => 120,
                'category_id' => 2,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:45:49',
            ),
            35 => 
            array (
                'product_id' => 36,
                'product_name' => 'Quần Jean Nữ',
                'product_photo' => 'quan_jean_nu.jpg',
                'product_description' => 'Quần jean nữ ống rộng, thời trang',
                'price' => '35.00',
                'stock_quantity' => 90,
                'category_id' => 2,
                'product_view' => 170,
                'create_at' => '2025-05-21 21:45:49',
            ),
            36 => 
            array (
                'product_id' => 37,
                'product_name' => 'Giày Thể Thao Nam',
                'product_photo' => 'giay_the_thao_nam.jpg',
                'product_description' => 'Giày thể thao nam, chất liệu da, bền và thoải mái',
                'price' => '55.00',
                'stock_quantity' => 150,
                'category_id' => 3,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:45:49',
            ),
            37 => 
            array (
                'product_id' => 38,
                'product_name' => 'Giày Thể Thao Nữ',
                'product_photo' => 'giay_the_thao_nu.jpg',
                'product_description' => 'Giày thể thao nữ, phong cách năng động, thoáng khí',
                'price' => '50.00',
                'stock_quantity' => 100,
                'category_id' => 3,
                'product_view' => 200,
                'create_at' => '2025-05-21 21:45:49',
            ),
            38 => 
            array (
                'product_id' => 39,
                'product_name' => 'Váy Đầm Công Sở',
                'product_photo' => 'vay_dam_cong_so.jpg',
                'product_description' => 'Váy đầm công sở nữ, sang trọng và thanh lịch',
                'price' => '45.00',
                'stock_quantity' => 60,
                'category_id' => 4,
                'product_view' => 100,
                'create_at' => '2025-05-21 21:45:49',
            ),
            39 => 
            array (
                'product_id' => 40,
                'product_name' => 'Váy Đầm Dạ Hội',
                'product_photo' => 'vay_dam_da_hoi.jpg',
                'product_description' => 'Váy đầm dạ hội cao cấp, thiết kế tinh tế',
                'price' => '120.00',
                'stock_quantity' => 30,
                'category_id' => 4,
                'product_view' => 50,
                'create_at' => '2025-05-21 21:45:49',
            ),
            40 => 
            array (
                'product_id' => 41,
                'product_name' => 'Túi Xách Nữ',
                'product_photo' => 'tui_xach_nu.jpg',
                'product_description' => 'Túi xách nữ kiểu dáng thời trang, chất liệu da',
                'price' => '60.00',
                'stock_quantity' => 80,
                'category_id' => 5,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:49',
            ),
            41 => 
            array (
                'product_id' => 42,
                'product_name' => 'Túi Xách Nam',
                'product_photo' => 'tui_xach_nam.jpg',
                'product_description' => 'Túi xách nam đa năng, phong cách lịch lãm',
                'price' => '70.00',
                'stock_quantity' => 60,
                'category_id' => 5,
                'product_view' => 120,
                'create_at' => '2025-05-21 21:45:49',
            ),
            42 => 
            array (
                'product_id' => 43,
                'product_name' => 'Mũ Lưỡi Trai',
                'product_photo' => 'mu_luoi_trai.jpg',
                'product_description' => 'Mũ lưỡi trai nam nữ, phong cách trẻ trung',
                'price' => '15.00',
                'stock_quantity' => 200,
                'category_id' => 6,
                'product_view' => 300,
                'create_at' => '2025-05-21 21:45:49',
            ),
            43 => 
            array (
                'product_id' => 44,
                'product_name' => 'Kính Mát Nữ',
                'product_photo' => 'kinh_mat_nu.jpg',
                'product_description' => 'Kính mát nữ thời trang, bảo vệ mắt khỏi tia UV',
                'price' => '25.00',
                'stock_quantity' => 120,
                'category_id' => 6,
                'product_view' => 250,
                'create_at' => '2025-05-21 21:45:49',
            ),
            44 => 
            array (
                'product_id' => 45,
                'product_name' => 'Áo Khoác Nam',
                'product_photo' => 'ao_khoac_nam.jpg',
                'product_description' => 'Áo khoác nam dày dặn, bảo vệ tốt trong mùa đông',
                'price' => '75.00',
                'stock_quantity' => 70,
                'category_id' => 7,
                'product_view' => 110,
                'create_at' => '2025-05-21 21:45:49',
            ),
            45 => 
            array (
                'product_id' => 46,
                'product_name' => 'Áo Khoác Nữ',
                'product_photo' => 'ao_khoac_nu.jpg',
                'product_description' => 'Áo khoác nữ kiểu dáng thanh lịch, ấm áp',
                'price' => '65.00',
                'stock_quantity' => 50,
                'category_id' => 7,
                'product_view' => 90,
                'create_at' => '2025-05-21 21:45:49',
            ),
            46 => 
            array (
                'product_id' => 47,
                'product_name' => 'Dép Sandal Nam',
                'product_photo' => 'dep_sandal_nam.jpg',
                'product_description' => 'Dép sandal nam, chất liệu da, phong cách đơn giản',
                'price' => '30.00',
                'stock_quantity' => 100,
                'category_id' => 8,
                'product_view' => 150,
                'create_at' => '2025-05-21 21:45:49',
            ),
            47 => 
            array (
                'product_id' => 48,
                'product_name' => 'Dép Sandal Nữ',
                'product_photo' => 'dep_sandal_nu.jpg',
                'product_description' => 'Dép sandal nữ, nhẹ nhàng và thoải mái',
                'price' => '28.00',
                'stock_quantity' => 120,
                'category_id' => 8,
                'product_view' => 180,
                'create_at' => '2025-05-21 21:45:49',
            ),
        ));
        
        
    }
}