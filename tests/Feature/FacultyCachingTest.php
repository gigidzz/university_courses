<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Faculty;
use App\Repositories\FacultyRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class FacultyCachingTest extends TestCase{
    public function testItUsesCacheToReturnFaculty()
    {
        Cache::flush();

        $faculty = Faculty::factory()->create(['name' => 'Cached Faculty']);

        $repo = app(FacultyRepositoryInterface::class);

        // 1st call: hits DB and caches
        $repo->findById($faculty->getId());

        $faculty->update(['name' => 'Changed Name']);

        $cachedFaculty = $repo->findById($faculty->getId());

        $this->assertEquals('Cached Faculty', $cachedFaculty->name);

    }

    public function test_cache_is_cleared_after_update()
    {
        Cache::flush();

        $faculty = Faculty::factory()->create(['name' => 'Before Update']);

        $repo = app(FacultyRepositoryInterface::class);

        $repo->findById($faculty->getId());

        // Update it via the repository
        $repo->update($faculty->getId(), ['name' => 'After Update']);

        // Should now return updated value
        $updatedFaculty = $repo->findById($faculty->getId());

        $this->assertEquals('After Update', $updatedFaculty->name);
    }

}
