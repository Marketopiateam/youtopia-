<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LeaveRequests\StoreLeaveRequestRequest;
use App\Http\Requests\Api\LeaveRequests\UpdateLeaveRequestRequest;
use App\Http\Resources\LeaveRequestResource;
use App\Models\LeaveRequest;
use App\Services\LeaveRequestService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LeaveRequestController extends ApiController
{
    public function __construct(private LeaveRequestService $service)
    {
        $this->authorizeResource(LeaveRequest::class, 'leave_request');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $leaveRequests = $this->service->paginateWith(['employee', 'leaveType'], $perPage);

        $data = $this->paginatedResponse(
            $leaveRequests,
            collect(LeaveRequestResource::collection($leaveRequests)->toArray($request))
        );

        return $this->success($data, 'Leave requests retrieved successfully.');
    }

    public function store(StoreLeaveRequestRequest $request)
    {
        $leaveRequest = $this->service->create($request->validated());
        $leaveRequest->load(['employee', 'leaveType']);

        return $this->success(
            (new LeaveRequestResource($leaveRequest))->toArray($request),
            'Leave request created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest->load(['employee', 'leaveType']);

        return $this->success(
            (new LeaveRequestResource($leaveRequest))->toArray($request),
            'Leave request retrieved successfully.'
        );
    }

    public function update(UpdateLeaveRequestRequest $request, LeaveRequest $leaveRequest)
    {
        $leaveRequest = $this->service->update($leaveRequest, $request->validated());
        $leaveRequest->load(['employee', 'leaveType']);

        return $this->success(
            (new LeaveRequestResource($leaveRequest))->toArray($request),
            'Leave request updated successfully.'
        );
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $this->service->delete($leaveRequest);

        return $this->success(null, 'Leave request deleted successfully.');
    }
}
