<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Catalogue;
use App\Models\Post;
use App\Traits\DataTables;
use App\Traits\QueryBuilder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
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
                model: new Post,
                relations: ['catalogue']
            );

            return $this->processDataTable(
                $query,
                fn($dataTable) =>

                $dataTable->addColumn(
                    'operations',
                    fn($row) =>
                    view('components.operation', [
                        'row' => $row,
                        'urlEdit' => route('admin.posts.update', $row),
                    ])->render()
                )
                    ->editColumn(
                        'thumbnail',
                        fn($row) =>
                        "<img src='" . showImage($row->thumbnail) . "' class='img-thumbnail'>"
                    )
                    ->editColumn('published_at', fn($row) => $row->published_at ? $row->published_at->format('d/m/Y') : '-----')
                    ->editColumn('catalogue_id', fn($row) => $row->catalogue->name ?? '-----')
                    ->editColumn('id', fn($row) => $row->id . ' | <small>' . $row->created_at->format('d/m/Y') . '</small>'),
                ['id', 'operations', 'thumbnail']
            );
        }
        return view('pages.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tạo mới bài viết';
        $post = null;

        $catalogues = Catalogue::query()
            ->orderBy('position')
            ->pluck('name', 'id')
            ->toArray();

        return view('pages.posts.form', compact('title', 'post', 'catalogues'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return transaction(function () use ($request) {
            $credentials = $request->validated();

            if ($request->filled('published_at')) {
                $credentials['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->input('published_at'))->format('Y-m-d H:i:s');
            }

            Post::create($credentials);

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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $title = "Chỉnh sửa bài viết - {$post->title}";
        $catalogues = Catalogue::query()
            ->orderBy('position')
            ->pluck('name', 'id')
            ->toArray();

        return view('pages.posts.form', compact('title', 'post', 'catalogues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        return transaction(function () use ($request, $post) {
            $credentials = $request->validated();

            if ($request->filled('published_at')) {
                $credentials['published_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->input('published_at'))->format('Y-m-d H:i:s');
            }

            $post->update($credentials);

            return successResponse(
                message: 'Chỉnh sửa bài viết thành công.',
                code: Response::HTTP_OK,
                isToastr: $request->input('submit_action') === 'save_exit'
            );
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
