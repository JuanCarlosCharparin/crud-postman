<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'uid' => '263548',
            'first_name' => 'Jaime',
            'email' => 'jaime@gmail.com',
            'password' => bcrypt('1234'),
            'address' => 'Av. Siempre 5622',
            'phone' => '261578945',
            'phone_2' => '2615789456',
            'postal_code' => '5519',
            'birth_date' => '2000-02-02',
            'gender' => 'female',
        ]);
    }
}

