<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatalogueRequest;
use App\Models\Catalogue;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CatalogueController extends Controller
{
    use QueryBuilder;
    use DataTables;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->queryBuilder(
                model: new Catalogue,
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => route('admin.catalogues.update', $row),
                    ])->render()

                )->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations']
            );
        }
        return view('pages.catalogues.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo mới danh mục';
        $catalogue = null;
        return view('pages.catalogues.form', compact('title', 'catalogue'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatalogueRequest $request)
    {
        return transaction(function () use ($request) {
            $credentials = $request->validated();

            if ($request->filled('is_slider')) {
                Catalogue::where('is_slider', true)->update(['is_slider' => false]);
            }

            Catalogue::create($credentials);

            return successResponse(
                message: 'Tạo mới danh mục thành công.',
                code: Response::HTTP_CREATED,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalogue $catalogue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogue $catalogue)
    {
        $title = "Chỉnh sửa danh mục - $catalogue->name";

        return view('pages.catalogues.form', compact('title', 'catalogue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatalogueRequest $request, Catalogue $catalogue)
    {
        return transaction(function () use ($request, $catalogue) {
            $credentials = $request->validated();

            if ($request->filled('is_slider') && !$catalogue->is_slider) {
                Catalogue::where('is_slider', true)->update(['is_slider' => false]);
            }

            $catalogue->update($credentials);

            return successResponse(
                message: 'Chỉnh sửa danh mục thành công.',
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }
}
