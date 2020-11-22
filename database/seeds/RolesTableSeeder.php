<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate(); // xóa tất cả csdl trong bảng
        Roles::create(['name'=>'administrator']);
        Roles::create(['name'=>'manager']);
        Roles::create(['name'=>'editor']);
        Roles::create(['name'=>'accountant']);
        Roles::create(['name'=>'shipper']);
    }
}
