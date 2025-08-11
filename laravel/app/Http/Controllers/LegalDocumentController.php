<?php

namespace App\Http\Controllers;

use App\Http\Requests\LegalDocumentRequest;
use App\Models\LegalDocument;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class LegalDocumentController extends Controller
{
    use QueryBuilder;
    use DataTables;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->queryBuilder(
                new LegalDocument,
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => route('admin.legal-documents.edit', $row),
                    ])->render()
                )
                    ->editColumn('file', fn($row) => "<a href='" . Storage::url($row->file) . "' class='fst-italic text-decoration-underline' target='_blank'>Xem tài liệu</a>")
                    ->editColumn('published_at', fn($row) => $row->published_at ? $row->published_at->format('d/m/Y') : '-----')
                    ->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations', 'file']
            );
        }

        return view('pages.legal-documents.index');
    }

    public function create()
    {
        $legalDocument = null;
        $title = 'Tạo mới văn bản pháp luật';
        return view('pages.legal-documents.form', compact('title', 'legalDocument'));
    }

    public function store(LegalDocumentRequest $request)
    {
        return transaction(function () use ($request) {

            $credentials = $request->validated();

            if ($request->hasFile('file')) {
                $file  = $request->file('file');

                $credentials['file'] =  Storage::put('legal-documents', $file);
            }

            LegalDocument::create($credentials);

            return successResponse(
                message: "Tạo mới văn bản pháp luật thành công.",
                code: Response::HTTP_CREATED,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }


    public function edit(LegalDocument $legalDocument)
    {
        $title = "Chỉnh sửa văn bản phát luật - {$legalDocument->title}";
        return view('pages.legal-documents.form', compact('title', 'legalDocument'));
    }

    public function update(LegalDocumentRequest $request, LegalDocument $legalDocument)
    {
        return transaction(function () use ($request, $legalDocument) {
            $credentials = $request->validated();

            if ($request->hasFile('file')) {
                if ($legalDocument->file && Storage::disk('public')->exists($legalDocument->file)) {
                    Storage::disk('public')->delete($legalDocument->file);
                }

                $credentials['file'] =  Storage::put('legal-documents', $request->file('file'));
            }

            $legalDocument->update($credentials);

            return successResponse(
                message: "Chỉnh sửa văn bản pháp luật thành công.",
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }
}
