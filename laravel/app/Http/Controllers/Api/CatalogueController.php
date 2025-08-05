<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogues = Catalogue::query()->published()->orderBy('position')->get();

        return successResponse(data: $catalogues);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $catalogue = Catalogue::query()->published()->where('slug', $slug)->firstOrFail();

        return successResponse(data: $catalogue);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
