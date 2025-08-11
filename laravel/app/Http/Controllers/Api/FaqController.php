<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 'home');

        $query = Faq::query()
            ->latest()
            ->published();

        $faqs = $page === 'home' ? $query->limit(10)->get() : $query->paginate(15);

        return successResponse(data: $faqs);
    }

    public function show(string $slug)
    {
        $faq = Faq::query()->published()->where('slug', $slug)->firstOrFail();

        return successResponse(data: $faq);
    }
}
