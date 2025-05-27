<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SystemUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Xoá dữ liệu cũ (nếu có)
        DB::table('system_users')->truncate();

        // Chèn dữ liệu mẫu
        DB::table('system_users')->insert([
            [
                'user_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('admin123'), // Mã hoá mật khẩu
                'email' => 'admin@example.com',
                'sodienthoai' => '0123456789',
                'role_id' => 1,
            ],
            [
                'user_id' => 2,
                'username' => 'editor',
                'password' => Hash::make('123456'),
                'email' => 'editor@example.com',
                'sodienthoai' => '0987654321',
                'role_id' => 2,
            ],
        ]);
    }
}
