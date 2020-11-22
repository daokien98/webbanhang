<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name','administrator')->first();
        $managerRoles = Roles::where('name','manager')->first();
        $editorRoles = Roles::where('name','editor')->first();
        $accountRoles = Roles::where('name','accountant')->first();
        $shipperRoles = Roles::where('name','shipper')->first();

        $administrator = Admin::create([
        	'admin_name' => 'kiendao',
        	'admin_email' => 'kien@gmail.com',
        	'admin_phone' => '0332630303',
        	'admin_password' => md5('123456')
        ]);

        $manager = Admin::create([
        	'admin_name' => 'kienmanager',
        	'admin_email' => 'kienmanager@gmail.com',
        	'admin_phone' => '0328478913',
        	'admin_password' => md5('123456')
        ]);

        $editor = Admin::create([
        	'admin_name' => 'haithanh',
        	'admin_email' => 'hai@gmail.com',
        	'admin_phone' => '021843216',
        	'admin_password' => md5('123456')
        ]);

        $accountant = Admin::create([
        	'admin_name' => 'minhhoat',
        	'admin_email' => 'hoat@gmail.com',
        	'admin_phone' => '022156486',
        	'admin_password' => md5('123456')
        ]);

        $shipper = Admin::create([
        	'admin_name' => 'haingo',
        	'admin_email' => 'haingo@gmail.com',
        	'admin_phone' => '0125499463',
        	'admin_password' => md5('123456')
        ]);

        $administrator->roles()->attach($adminRoles);
        $manager->roles()->attach($managerRoles);
        $editor->roles()->attach($editorRoles);
        $accountant->roles()->attach($accountRoles);
        $shipper->roles()->attach($shipperRoles);

        factory::(App\Admin::class, 10)->create
    }
}
