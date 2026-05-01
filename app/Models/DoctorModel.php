<?php

namespace App\Models;

use CodeIgniter\Model;

class DoctorModel extends Model
{
    protected $table      = 'doctors';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'specialty_id',
        'code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'schedule',
        'is_active',
    ];

    protected $useTimestamps = false;

    /**
     * Retorna doctores con el nombre de su especialidad.
     */
    public function getWithSpecialty(): array
    {
        return $this->select('doctors.*, specialties.name as specialty_name')
            ->join('specialties', 'specialties.id = doctors.specialty_id')
            ->orderBy('doctors.last_name', 'ASC')
            ->findAll();
    }

    /**
     * Retorna doctores activos de una especialidad.
     */
    public function getBySpecialty(int $specialtyId): array
    {
        return $this->select('doctors.id, doctors.first_name, doctors.last_name, doctors.code, doctors.schedule')
            ->where('doctors.specialty_id', $specialtyId)
            ->where('doctors.is_active', 1)
            ->orderBy('doctors.last_name', 'ASC')
            ->findAll();
    }

    /**
     * Valida unicidad del código.
     */
    public function validateCode(string $code, ?int $id = null): bool
    {
        $builder = $this->where('code', $code);
        if ($id !== null) {
            $builder->where('id !=', $id);
        }
        return $builder->first() === null;
    }
}
