<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table      = 'patients';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'email',
        'phone',
        'address',
        'blood_type',
        'allergies',
        'notes',
        'is_active',
    ];

    protected $useTimestamps = false;

    /**
     * Valida que el código no esté en uso por otro paciente.
     */
    public function validateCode(string $code, ?int $id = null): bool
    {
        if ($id !== null) {
            $current = $this->find($id);
            if ($current && $current['code'] === $code) {
                return true;
            }
        }

        $builder = $this->where('code', $code);
        if ($id !== null) {
            $builder->where('id !=', $id);
        }

        return $builder->first() === null;
    }
}