<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WorklifePosts\StoreWorklifePostRequest;
use App\Http\Requests\Api\WorklifePosts\UpdateWorklifePostRequest;
use App\Http\Resources\WorklifePostResource;
use App\Models\WorklifePost;
use App\Services\WorklifePostService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorklifePostController extends ApiController
{
    public function __construct(private WorklifePostService $service)
    {
        $this->authorizeResource(WorklifePost::class, 'worklife_post');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $posts = $this->service->paginateWith(['author'], $perPage);

        $data = $this->paginatedResponse(
            $posts,
            collect(WorklifePostResource::collection($posts)->toArray($request))
        );

        return $this->success($data, 'Worklife posts retrieved successfully.');
    }

    public function store(StoreWorklifePostRequest $request)
    {
        $post = $this->service->create($request->validated());
        $post->load(['author']);

        return $this->success(
            (new WorklifePostResource($post))->toArray($request),
            'Worklife post created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, WorklifePost $worklifePost)
    {
        $worklifePost->load(['author']);

        return $this->success(
            (new WorklifePostResource($worklifePost))->toArray($request),
            'Worklife post retrieved successfully.'
        );
    }

    public function update(UpdateWorklifePostRequest $request, WorklifePost $worklifePost)
    {
        $worklifePost = $this->service->update($worklifePost, $request->validated());
        $worklifePost->load(['author']);

        return $this->success(
            (new WorklifePostResource($worklifePost))->toArray($request),
            'Worklife post updated successfully.'
        );
    }

    public function destroy(WorklifePost $worklifePost)
    {
        $this->service->delete($worklifePost);

        return $this->success(null, 'Worklife post deleted successfully.');
    }
}
