<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Meetings\StoreMeetingRequest;
use App\Http\Requests\Api\Meetings\UpdateMeetingRequest;
use App\Http\Resources\MeetingResource;
use App\Models\Meeting;
use App\Services\MeetingService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeetingController extends ApiController
{
    public function __construct(private MeetingService $service)
    {
        $this->authorizeResource(Meeting::class, 'meeting');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $meetings = $this->service->paginateWith(['organizer'], $perPage);

        $data = $this->paginatedResponse(
            $meetings,
            collect(MeetingResource::collection($meetings)->toArray($request))
        );

        return $this->success($data, 'Meetings retrieved successfully.');
    }

    public function store(StoreMeetingRequest $request)
    {
        $meeting = $this->service->create($request->validated());
        $meeting->load(['organizer']);

        return $this->success(
            (new MeetingResource($meeting))->toArray($request),
            'Meeting created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, Meeting $meeting)
    {
        $meeting->load(['organizer']);

        return $this->success(
            (new MeetingResource($meeting))->toArray($request),
            'Meeting retrieved successfully.'
        );
    }

    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        $meeting = $this->service->update($meeting, $request->validated());
        $meeting->load(['organizer']);

        return $this->success(
            (new MeetingResource($meeting))->toArray($request),
            'Meeting updated successfully.'
        );
    }

    public function destroy(Meeting $meeting)
    {
        $this->service->delete($meeting);

        return $this->success(null, 'Meeting deleted successfully.');
    }
}
