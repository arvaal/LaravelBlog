<?php

namespace Database\Seeders;

use App\Models\Account\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
         User::factory()->create([
             'is_admin' => 0,
             'avatar' => 'no-image.jpg',
             'name' => 'bloger',
             'email' => 'arvaal@mail.ru',
             'password' => '8844',
         ]);
    }
}
