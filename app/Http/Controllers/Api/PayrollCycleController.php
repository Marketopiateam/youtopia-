<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PayrollCycles\StorePayrollCycleRequest;
use App\Http\Requests\Api\PayrollCycles\UpdatePayrollCycleRequest;
use App\Http\Resources\PayrollCycleResource;
use App\Models\PayrollCycle;
use App\Services\PayrollCycleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PayrollCycleController extends ApiController
{
    public function __construct(private PayrollCycleService $service)
    {
        $this->authorizeResource(PayrollCycle::class, 'payroll_cycle');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $cycles = $this->service->paginateWith(['processedBy'], $perPage);

        $data = $this->paginatedResponse(
            $cycles,
            collect(PayrollCycleResource::collection($cycles)->toArray($request))
        );

        return $this->success($data, 'Payroll cycles retrieved successfully.');
    }

    public function store(StorePayrollCycleRequest $request)
    {
        $cycle = $this->service->create($request->validated());
        $cycle->load(['processedBy']);

        return $this->success(
            (new PayrollCycleResource($cycle))->toArray($request),
            'Payroll cycle created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, PayrollCycle $payrollCycle)
    {
        $payrollCycle->load(['processedBy']);

        return $this->success(
            (new PayrollCycleResource($payrollCycle))->toArray($request),
            'Payroll cycle retrieved successfully.'
        );
    }

    public function update(UpdatePayrollCycleRequest $request, PayrollCycle $payrollCycle)
    {
        $payrollCycle = $this->service->update($payrollCycle, $request->validated());
        $payrollCycle->load(['processedBy']);

        return $this->success(
            (new PayrollCycleResource($payrollCycle))->toArray($request),
            'Payroll cycle updated successfully.'
        );
    }

    public function destroy(PayrollCycle $payrollCycle)
    {
        $this->service->delete($payrollCycle);

        return $this->success(null, 'Payroll cycle deleted successfully.');
    }
}
