<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Surveys\StoreSurveyRequest;
use App\Http\Requests\Api\Surveys\UpdateSurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Models\Survey;
use App\Services\SurveyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SurveyController extends ApiController
{
    public function __construct(private SurveyService $service)
    {
        $this->authorizeResource(Survey::class, 'survey');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $surveys = $this->service->paginateWith(['creator'], $perPage);

        $data = $this->paginatedResponse(
            $surveys,
            collect(SurveyResource::collection($surveys)->toArray($request))
        );

        return $this->success($data, 'Surveys retrieved successfully.');
    }

    public function store(StoreSurveyRequest $request)
    {
        $survey = $this->service->create($request->validated());
        $survey->load(['creator']);

        return $this->success(
            (new SurveyResource($survey))->toArray($request),
            'Survey created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, Survey $survey)
    {
        $survey->load(['creator']);

        return $this->success(
            (new SurveyResource($survey))->toArray($request),
            'Survey retrieved successfully.'
        );
    }

    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $survey = $this->service->update($survey, $request->validated());
        $survey->load(['creator']);

        return $this->success(
            (new SurveyResource($survey))->toArray($request),
            'Survey updated successfully.'
        );
    }

    public function destroy(Survey $survey)
    {
        $this->service->delete($survey);

        return $this->success(null, 'Survey deleted successfully.');
    }
}
