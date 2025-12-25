<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PerformanceReviews\StorePerformanceReviewRequest;
use App\Http\Requests\Api\PerformanceReviews\UpdatePerformanceReviewRequest;
use App\Http\Resources\PerformanceReviewResource;
use App\Models\PerformanceReview;
use App\Services\PerformanceReviewService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PerformanceReviewController extends ApiController
{
    public function __construct(private PerformanceReviewService $service)
    {
        $this->authorizeResource(PerformanceReview::class, 'performance_review');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $reviews = $this->service->paginateWith(['template', 'employee', 'reviewer'], $perPage);

        $data = $this->paginatedResponse(
            $reviews,
            collect(PerformanceReviewResource::collection($reviews)->toArray($request))
        );

        return $this->success($data, 'Performance reviews retrieved successfully.');
    }

    public function store(StorePerformanceReviewRequest $request)
    {
        $review = $this->service->create($request->validated());
        $review->load(['template', 'employee', 'reviewer']);

        return $this->success(
            (new PerformanceReviewResource($review))->toArray($request),
            'Performance review created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, PerformanceReview $performanceReview)
    {
        $performanceReview->load(['template', 'employee', 'reviewer']);

        return $this->success(
            (new PerformanceReviewResource($performanceReview))->toArray($request),
            'Performance review retrieved successfully.'
        );
    }

    public function update(UpdatePerformanceReviewRequest $request, PerformanceReview $performanceReview)
    {
        $performanceReview = $this->service->update($performanceReview, $request->validated());
        $performanceReview->load(['template', 'employee', 'reviewer']);

        return $this->success(
            (new PerformanceReviewResource($performanceReview))->toArray($request),
            'Performance review updated successfully.'
        );
    }

    public function destroy(PerformanceReview $performanceReview)
    {
        $this->service->delete($performanceReview);

        return $this->success(null, 'Performance review deleted successfully.');
    }
}
