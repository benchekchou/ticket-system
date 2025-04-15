<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket; 
class DatabaseSeeder extends Seeder
{
  
public function run() {
    User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'is_admin' => true,
        'password' => bcrypt('password')
    ]);

    User::factory()->create([
        'name' => 'User',
        'email' => 'user@example.com',
        'password' => bcrypt('password')
    ]);

    Ticket::factory(10)->create(['user_id' => 2])->each(function ($ticket) {
        $ticket->replies()->create([
            'user_id' => rand(1, 2),
            'message' => fake()->paragraph()
        ]);
    });
}
}
