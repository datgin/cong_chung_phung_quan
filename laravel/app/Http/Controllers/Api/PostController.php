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

        // lấy catalogue có is_service = true
        $catalogIsService = Catalogue::query()->where('is_service', true)->first();

        // nếu có slug thì lấy theo slug, không thì lấy catalogue service
        $catalogue = $catalogueSlug
            ? Catalogue::query()->where('slug', $catalogueSlug)->firstOrFail()
            : $catalogIsService;

        $query = Post::query()
            ->published()
            ->when($catalogue, fn($q) => $q->where('catalogue_id', $catalogue->id))
            ->with(['catalogue'])
            ->latest()
            ->limit(20);

        // nếu có slug thì phân trang, còn lại thì chỉ get theo limit
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
