<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $useSoftDeletes = true;
    protected $protectFields = true;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'type',
        'account_status',
        'email_activated',
        'deleted_at' // added for manual reset/reactivation
    ];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'first_name'    => 'required|min_length[2]|max_length[50]',
        'last_name'     => 'required|min_length[2]|max_length[50]',
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password_hash' => 'permit_empty|min_length[6]', // allow empty for updates
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'This email is already taken.'
        ]
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!empty($data['data']['password_hash'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password_hash']); // prevent overwriting with null
        }

        return $data;
    }
}
