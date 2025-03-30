<?php

namespace App\Repositories;

use App\Models\Faculty;
use Illuminate\Pagination\LengthAwarePaginator;

class FacultyRepository implements FacultyRepositoryInterface
{
    protected Faculty $model;

    public function __construct(Faculty $faculty)
    {
        $this->model = $faculty;
    }

    public function getAllPaginated(int $perPage = 5): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): ?Faculty
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Faculty
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Faculty
    {
        $faculty = $this->findById($id);
        $faculty->update($data);
        return $faculty;
    }

    public function delete(int $id): bool
    {
        $faculty = $this->model->find($id);
        if (!$faculty) {
            return false;
        }
        return $faculty->delete();
    }
}
