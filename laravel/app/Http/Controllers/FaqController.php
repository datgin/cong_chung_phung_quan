<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqController extends Controller
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
                model: new Faq(),
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => route('admin.faqs.edit', $row),
                    ])->render()

                )
                    ->editColumn(
                        'thumbnail',
                        fn($row) =>
                        "<img src='" . showImage($row->thumbnail) . "' class='img-thumbnail'>"
                    )->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations', 'thumbnail']
            );
        }
        return view('pages.faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm câu hỏi";
        $faq = null;
        return view('pages.faqs.form', compact('title', 'faq'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqRequest $request)
    {

        return transaction(function () use ($request) {
            $crendentials = $request->validated();

            Faq::create($crendentials);

            return successResponse(
                message: "Thêm câu hỏi thành công.",
                code: Response::HTTP_CREATED,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        $title = "Chỉnh sửa câu hỏi - {$faq->title}";
        return view('pages.faqs.form', compact('title', 'faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        return transaction(function () use ($request, $faq) {
            $credentials = $request->validated();

            $faq->update($credentials);

            return successResponse(
                message: "Chỉnh sửa câu hỏi thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        //
    }
}
