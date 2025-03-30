<?php

namespace App\Repositories;

use App\Models\Faculty;
use Illuminate\Pagination\LengthAwarePaginator;

interface FacultyRepositoryInterface
{
    public function getAllPaginated(int $perPage = 5): LengthAwarePaginator;
    public function findById(int $id): ?Faculty;

    public function create(array $data): Faculty;
    public function update(int $id, array $data): Faculty;
    public function delete(int $id): bool;
}
