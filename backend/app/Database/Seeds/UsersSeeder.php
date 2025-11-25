<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
        $password = password_hash('Password123!', PASSWORD_DEFAULT);

        $data = [
            // ✅ MANAGER ACCOUNT
            [
                'first_name'       => 'Admin',
                'last_name'        => 'User',
                'email'            => 'admin@pizza.com',
                'password_hash'    => $password,
                'type'             => 'manager',
                'account_status'   => 1,
                'email_activated'  => 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],

            // ✅ CLIENT ACCOUNTS
            [
                'first_name'       => 'Son',
                'last_name'        => 'Goku',
                'email'            => 'Goku@example.com',
                'password_hash'    => $password,
                'type'             => 'client',
                'account_status'   => 1,
                'email_activated'  => 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'first_name'       => 'Jane',
                'last_name'        => 'Smith',
                'email'            => 'jane@example.com',
                'password_hash'    => $password,
                'type'             => 'client',
                'account_status'   => 1,
                'email_activated'  => 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
    
            [
                'first_name'       => 'Bob',
                'last_name'        => 'Brown',
                'email'            => 'bob@example.com',
                'password_hash'    => $password,
                'type'             => 'client',
                'account_status'   => 1,
                'email_activated'  => 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'first_name'       => 'Eve',
                'last_name'        => 'Miller',
                'email'            => 'eve@example.com',
                'password_hash'    => $password,
                'type'             => 'client',
                'account_status'   => 1,
                'email_activated'  => 1,
                'created_at'       => $now,
                'updated_at'       => $now,
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
