<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserFactory::new();

        $admin = [
            'role_id' => User::ROLE_ADMIN,
            'name' => 'George Kamau',
            'email' => 'georgekamau@hotmail.com',
            'phone_number' => 224242424,
            'date_joined' => '2016-04-09',
            'department' => 'VMix',
            'account_status' => 'approved',
            'password' => Hash::make('georgekkamash'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ];

        DB::table('users')->insert($admin);
    }
}
