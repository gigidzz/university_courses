<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Faculty;
use App\Repositories\FacultyRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class FacultyService
{
    protected FacultyRepositoryInterface $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    public function getAllFacultiesPaginated(int $perPage = 5): LengthAwarePaginator
    {
        return $this->facultyRepository->getAllPaginated($perPage);
    }
    public function getFacultyById(int $id): Faculty
    {
        return $this->facultyRepository->findById($id);
    }
    public function createFaculty(array $data): Faculty
    {
        return $this->facultyRepository->create($data);
    }
    public function updateFaculty(int $id, array $data): Faculty
    {
        return $this->facultyRepository->update($id, $data);
    }
    public function deleteFaculty(int $id): bool
    {
        return $this->facultyRepository->delete($id);
    }
}
