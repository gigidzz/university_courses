<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function index(): JsonResponse
    {
        $faculties = $this->facultyService->getAllFacultiesPaginated();

        return response()->json(['data'=>$faculties],Response::HTTP_OK);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $faculty = $this->facultyService->createFaculty($validated);

        return response()->json(['data'=>$faculty],Response::HTTP_CREATED);
    }
    public function show(int $id): JsonResponse
    {
        $faculty = $this->facultyService->getFacultyById($id);

        return response()->json(['data'=>$faculty],Response::HTTP_OK);
    }
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $faculty = $this->facultyService->updateFaculty($id,$validated);

        return response()->json(['data'=>$faculty],Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->facultyService->deleteFaculty($id);

        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
