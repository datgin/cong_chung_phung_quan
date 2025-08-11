<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LegalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class LegalDocumentController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 'home');

        $query = LegalDocument::query()
            ->published()
            ->latest();

        $legalDocument = $page === 'home'
            ? $query->limit(10)->get()
            : $query->paginate(15);

        return successResponse(data: $legalDocument);
    }

    public function show(string $slug)
    {
        $legalDocument = LegalDocument::query()->published()->where('slug', $slug)->firstOrFail();

        return successResponse(data: $legalDocument);
    }

    public function downloadFile($file)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');

        $filePath = "legal-documents/{$file}";

        if (!$disk->exists($filePath)) {
            return errorResponse("File không tồn tại hoặc đã bị hỏng!", Response::HTTP_NOT_FOUND);
        }

        return $disk->download($filePath);
    }
}
