<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Gender::factory()->create([
            'gender' => 'Male'
        ]);

        \App\Models\Gender::factory()->create([
            'gender' => 'Female'
        ]);

        \App\Models\Gender::factory()->create([
            'gender' => 'Others'
        ]);

        \App\Models\UserRole::factory()->create([
            'role' => 'Admin'
        ]);

        \App\Models\UserRole::factory()->create([
            'role' => 'Cashier'
        ]);

        \App\Models\UserRole::factory()->create([
            'role' => 'Client'
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'age' => 100,
            'gender_id' => 1,
            'email' => 'admin@admin.com',
            'contact_number' => '09123456789',
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'user_role_id' => 1
        ]);

        \App\Models\User::factory()->create([
            'first_name' => 'Juan',
            'middle_name' => null,
            'last_name' => 'Dela Cruz',
            'age' => 57,
            'gender_id' => 1,
            'email' => 'juan@user.com',
            'contact_number' => '09123456789',
            'username' => 'juan',
            'password' => bcrypt('123'),
            'user_role_id' => 3
        ]);

        \App\Models\Category::factory()->create([
            'category' => 'Duplex'
        ]);

        \App\Models\Category::factory()->create([
            'category' => 'Single-Family Home'
        ]);

        \App\Models\Category::factory()->create([
            'category' => 'Multi-Family Home'
        ]);

        \App\Models\Category::factory()->create([
            'category' => '2 Story House'
        ]);

        \App\Models\PaymentMethod::factory()->create([
            'payment_method' => 'Cash'
        ]);

        \App\Models\PaymentMethod::factory()->create([
            'payment_method' => 'GCash'
        ]);

        \App\Models\Downpayment::factory()->create([
            'downpayment' => 10000
        ]);

        \App\Models\Downpayment::factory()->create([
            'downpayment' => 30000
        ]);

        \App\Models\Downpayment::factory()->create([
            'downpayment' => 50000
        ]);

        \App\Models\User::factory(200)->create();
        \App\Models\House::factory(20)->create();
        \App\Models\ClientHouse::factory(300)->create();
        \App\Models\Payment::factory(400)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
