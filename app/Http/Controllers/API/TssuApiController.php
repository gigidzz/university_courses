<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TssuResource;
use App\Http\Resources\TssuCollection;
use App\Services\FacultyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class TssuApiController extends Controller
{
    protected FacultyService $facultyService;

    public function __construct(FacultyService $facultyService)
    {
        $this->facultyService = $facultyService;
    }

    public function index(): TssuCollection
    {
        $faculties = $this->facultyService->getAllFacultiesPaginated();

        return new TssuCollection($faculties);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $faculty = $this->facultyService->createFaculty($validated);

        return new TssuResource($faculty)->response()->setStatusCode(Response::HTTP_CREATED);
    }
    public function show(int $id): TssuResource
    {
        $faculty = $this->facultyService->getFacultyById($id);

        return new TssuResource($faculty);
    }
    public function update(Request $request, int $id): TssuResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $faculty = $this->facultyService->updateFaculty($id, $validated);

        return new TssuResource($faculty);
    }

    public function destroy(int $id): Response
    {
        $this->facultyService->deleteFaculty($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
