<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Employees\StoreEmployeeRequest;
use App\Http\Requests\Api\Employees\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends ApiController
{
    public function __construct(private EmployeeService $service)
    {
        $this->authorizeResource(Employee::class, 'employee');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $employees = $this->service->paginateWith(['user', 'department', 'manager'], $perPage);

        $data = $this->paginatedResponse(
            $employees,
            collect(EmployeeResource::collection($employees)->toArray($request))
        );

        return $this->success($data, 'Employees retrieved successfully.');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->service->create($request->validated());
        $employee->load(['user', 'department', 'manager']);

        return $this->success(
            (new EmployeeResource($employee))->toArray($request),
            'Employee created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, Employee $employee)
    {
        $employee->load(['user', 'department', 'manager']);

        return $this->success(
            (new EmployeeResource($employee))->toArray($request),
            'Employee retrieved successfully.'
        );
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee = $this->service->update($employee, $request->validated());
        $employee->load(['user', 'department', 'manager']);

        return $this->success(
            (new EmployeeResource($employee))->toArray($request),
            'Employee updated successfully.'
        );
    }

    public function destroy(Employee $employee)
    {
        $this->service->delete($employee);

        return $this->success(null, 'Employee deleted successfully.');
    }
}
