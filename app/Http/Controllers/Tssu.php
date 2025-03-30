<?php

namespace App\Http\Controllers;

use App\Services\FacultyService;
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
}
