<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Models\Library;
use App\Models\User;
use Inertia\Inertia;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Return Inertia::render('library/index', [
            'libraries' => Library::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Return Inertia::render('library/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLibraryRequest $request)
    {
        $library = Library::create($request->validated());

        return response()->json([
            'message' => 'Library created successfully',
            'data' => $library
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        Return Inertia::render('library/show', [
            'library' => $library
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        return Inertia::render('library/edit', [
            'library' => $library,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLibraryRequest $request, Library $library)
    {
        $validatedData = $request->validated();

        $library->update($validatedData);

        return response()->json([
            'message' => 'Library updated successfully',
            'data' => $library,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        $library->delete();

        return response()->json([
            'message' => 'Library deleted successfully',
        ], 200);
    }

    /**
     * Register a user with this Library.
     */
    public function register(Library $library, User $user)
    {
        try {
            $user->libraries()->attach($library->id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not register user for library',
            ], 422);
        }

        return response()->json([
            'message' => 'User registered successfully',
        ], 201);
    }

    /**
     * Deregister a user with this Library.
     */
    public function deregister(Library $library, User $user)
    {
        try {
            $user->libraries()->detach($library->id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Could not deregister user for library',
            ], 422);
        }

        return response()->json([
            'message' => 'User deregistered successfully',
        ], 201);
    }

}
