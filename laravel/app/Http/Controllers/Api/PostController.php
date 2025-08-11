<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $catalogueSlug = $request->input('catalogueSlug', null);

        $catalogue = $catalogueSlug ? Catalogue::query()
            ->where('slug', $catalogueSlug)
            ->firstOrFail() : '';

        $query = Post::query()
            ->published()
            ->when(!empty($catalogueSlug), fn($q) => $q->where('catalogue_id', $catalogue->id))
            ->with(['catalogue'])
            ->latest()
            ->limit(20);

        $posts = $catalogueSlug ? $query->paginate(15) : $query->get();

        return successResponse(data: $posts);
    }

    public function show(string $slug)
    {

        if (!$post = Post::query()
            ->published()
            ->where('slug', $slug)
            ->with(['catalogue'])
            ->first()) {

            return errorResponse("Bài viết không tồn tại!", 404);
        }

        return successResponse(data: $post);
    }

    public function latest()
    {
        $posts = Post::query()
            ->published()
            ->latest('updated_at')
            ->with(['catalogue'])
            ->limit(6)
            ->get();

        return response()->json([
            'data' => $posts
        ]);
    }

    public function getSliderPosts()
    {
        $catalogue = Catalogue::query()
            ->where('is_slider', true)
            ->first();

        $posts = Post::query()
            ->where('catalogue_id', $catalogue->id)
            ->published()
            ->latest('updated_at')
            ->get();

        return successResponse(data: [
            'posts' => $posts,
            'catalogue' => $catalogue
        ]);
    }
}
