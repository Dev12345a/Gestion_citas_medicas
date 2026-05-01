<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecialtyModel extends Model
{
    protected $table      = 'specialties';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'description',
        'is_active',
    ];

    protected $useTimestamps = false;

    public function getActive(): array
    {
        return $this->where('is_active', 1)->orderBy('name', 'ASC')->findAll();
    }
}
