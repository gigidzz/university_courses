<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Faculty;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CachedFacultyRepository implements FacultyRepositoryInterface
{
    protected FacultyRepositoryInterface $repository;
    protected int $cacheTime = 3600;

    public function __construct(FacultyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPaginated(int $perPage = 5): LengthAwarePaginator
    {
        $cacheKey = 'faculties.paginated.' . $perPage;

        return Cache::remember($cacheKey, $this->cacheTime, function () use ($perPage) {
            return $this->repository->getAllPaginated($perPage);
        });
    }

    public function findById(int $id): ?Faculty
    {
        $cacheKey = 'faculties.' . $id;

        return Cache::remember($cacheKey, $this->cacheTime, function () use ($id) {
            return $this->repository->findById($id);
        });
    }

    public function create(array $data): Faculty
    {
        $faculty = $this->repository->create($data);

        // ClearCache implemented below
        $this->clearCache();

        return $faculty;
    }

    public function update(int $id, array $data): Faculty
    {
        $faculty = $this->repository->update($id, $data);

        // clearCache implemented below
        $this->clearCache($id);

        return $faculty;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);

        // clearCache implemented below
        $this->clearCache($id);

        return $result;
    }

    protected function clearCache(?int $id = null): void
    {

        Cache::forget('faculties.paginated.5');


        if ($id !== null) {
            Cache::forget('faculties.' . $id);
        }
    }
}
