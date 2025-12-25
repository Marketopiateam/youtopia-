<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\OkrObjectives\StoreOkrObjectiveRequest;
use App\Http\Requests\Api\OkrObjectives\UpdateOkrObjectiveRequest;
use App\Http\Resources\OkrObjectiveResource;
use App\Models\OkrObjective;
use App\Services\OkrObjectiveService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OkrObjectiveController extends ApiController
{
    public function __construct(private OkrObjectiveService $service)
    {
        $this->authorizeResource(OkrObjective::class, 'okr_objective');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $objectives = $this->service->paginateWith(['cycle', 'owner', 'parent'], $perPage);

        $data = $this->paginatedResponse(
            $objectives,
            collect(OkrObjectiveResource::collection($objectives)->toArray($request))
        );

        return $this->success($data, 'OKR objectives retrieved successfully.');
    }

    public function store(StoreOkrObjectiveRequest $request)
    {
        $objective = $this->service->create($request->validated());
        $objective->load(['cycle', 'owner', 'parent']);

        return $this->success(
            (new OkrObjectiveResource($objective))->toArray($request),
            'OKR objective created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, OkrObjective $okrObjective)
    {
        $okrObjective->load(['cycle', 'owner', 'parent']);

        return $this->success(
            (new OkrObjectiveResource($okrObjective))->toArray($request),
            'OKR objective retrieved successfully.'
        );
    }

    public function update(UpdateOkrObjectiveRequest $request, OkrObjective $okrObjective)
    {
        $okrObjective = $this->service->update($okrObjective, $request->validated());
        $okrObjective->load(['cycle', 'owner', 'parent']);

        return $this->success(
            (new OkrObjectiveResource($okrObjective))->toArray($request),
            'OKR objective updated successfully.'
        );
    }

    public function destroy(OkrObjective $okrObjective)
    {
        $this->service->delete($okrObjective);

        return $this->success(null, 'OKR objective deleted successfully.');
    }
}
