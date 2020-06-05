<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'email' => 'admin@test.com',
                'password' => Hash::make('test123'), // password
                'name' => 'Admin',
                'id_no' => 1234567890,
                'birthdate' => '2020-02-02',
                'role' => 'admin',
                'gender' => 'Others',
                'status' => 'Approved',
                'document' => NULL,
            ],
            [
                'email' => 'customer@test.com',
                'password' => Hash::make('test123'), // password
                'name' => 'Customer',
                'id_no' => 9876543210,
                'birthdate' => '2020-02-02',
                'role' => 'customer',
                'gender' => 'Others',
                'status' => 'Pending',
                'document' => 'idcard/D9jv4fKfHP7HEOuMMWe96TgiNRcExJQu1wvvcRo0.pdf',
            ]
        ];

        foreach ($users as $user){
            App\User::create($user);
        }
    }
}
