<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1 Data
        // $data = [
        //     'name_user' => 'Administrator',
        //     'email_user' => 'fulan.12@gmail.com',
        //     'password_user' => password_hash('12345', PASSWORD_BCRYPT)
        // ];
        // $this->db->table('users')->insert($data);

        // multi data
        $data = [
            [
            'name_user' => 'Fredator',
            'email_user' => 'Fred12@gmail.com',
            'password_user' => password_hash('samba', PASSWORD_BCRYPT)
            ],
            [
                'name_user' => 'Penaldo',
                'email_user' => 'siuu@gmail.com',
                'password_user' => password_hash('siuu', PASSWORD_BCRYPT)
            ],
        ];
        $this -> db -> table('users') -> insertBatch($data);
    }
}
