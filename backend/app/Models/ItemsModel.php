<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Item;

class ItemsModel extends Model
{
    protected $table      = 'items';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'title',
        'cost',
        'is_available',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [
        'title'        => 'required|min_length[2]',
        'description'  => 'permit_empty|max_length[255]',
        'cost'         => 'required|decimal',
        'is_available' => 'required|in_list[0,1]',
        'is_active'    => 'required|in_list[0,1]',
        'image'        => 'permit_empty|valid_url',
        'category'     => 'permit_empty'
    ];
}
