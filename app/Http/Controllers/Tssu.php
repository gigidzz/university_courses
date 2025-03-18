<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Services\FacultyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Tssu extends Controller
{

    protected facultyService $facultyService;

    public function __construct(facultyService $facultyService)
    {
        $this->facultyService = $facultyService;
    }

    public function index(): View
    {
        $faculties = $this->facultyService->getAllFacultiesPaginated();
        return view('faculties.index', compact('faculties'));
    }

    public function create(): View
    {
        return view('faculties.create');
    }
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $this->facultyService->createFaculty($validated);

        return redirect()->route('faculties.index')->with('success', 'Faculty created successfully!');
    }
    public function show(int $id): View
    {
        $faculty = $this->facultyService->getFacultyById($id);
        return view('faculties.show', compact('faculty'));
    }

    public function edit(int $id): View
    {
        $faculty = $this->facultyService->getFacultyById($id);
        return view('faculties.edit', compact('faculty'));
    }
    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive',
        ]);

        $this->facultyService->updateFaculty($id, $validated);

        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully!');
    }
    public function destroy(int $id): RedirectResponse
    {
        $result = $this->facultyService->deleteFaculty($id);

        if ($result) {
            return redirect()->route('faculties.index')->with('success', 'Faculty deleted successfully!');
        }

        return redirect()->route('faculties.index')->with('error', 'Faculty not found!');
    }


    public function indexApi(): JsonResponse
    {
        $faculties = Faculty::paginate(5);
        return response()->json($faculties);
    }

    public function showApi(int $id): JsonResponse
    {
        $faculty = Faculty::findOrFail($id);
        return response()->json($faculty);
    }


    public function storeApi(Request $request): JsonResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);

        $faculty = Faculty::create($request->all());
        return response()->json($faculty, 201); // Return created faculty with status 201
    }

    public function updateApi(Request $request,int $id): JsonResponse
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:active,inactive',
        ]);


        $faculty = Faculty::findOrFail($id);
        $faculty->update($request->all());
        return response()->json($faculty);
    }

    public function destroyApi(int $id): JsonResponse
    {
        $faculty = Faculty::find($id);

        if ($faculty) {
            $faculty->delete();
            return response()->json(['message' => 'Faculty deleted successfully']);
        }

        return response()->json(['message' => 'Faculty not found'], 404);
    }
}
