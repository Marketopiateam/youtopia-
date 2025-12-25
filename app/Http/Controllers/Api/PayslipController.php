<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Payslips\StorePayslipRequest;
use App\Http\Requests\Api\Payslips\UpdatePayslipRequest;
use App\Http\Resources\PayslipResource;
use App\Models\Payslip;
use App\Services\PayslipService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PayslipController extends ApiController
{
    public function __construct(private PayslipService $service)
    {
        $this->authorizeResource(Payslip::class, 'payslip');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $payslips = $this->service->paginateWith(['payrollCycle', 'employee'], $perPage);

        $data = $this->paginatedResponse(
            $payslips,
            collect(PayslipResource::collection($payslips)->toArray($request))
        );

        return $this->success($data, 'Payslips retrieved successfully.');
    }

    public function store(StorePayslipRequest $request)
    {
        $payslip = $this->service->create($request->validated());
        $payslip->load(['payrollCycle', 'employee']);

        return $this->success(
            (new PayslipResource($payslip))->toArray($request),
            'Payslip created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, Payslip $payslip)
    {
        $payslip->load(['payrollCycle', 'employee']);

        return $this->success(
            (new PayslipResource($payslip))->toArray($request),
            'Payslip retrieved successfully.'
        );
    }

    public function update(UpdatePayslipRequest $request, Payslip $payslip)
    {
        $payslip = $this->service->update($payslip, $request->validated());
        $payslip->load(['payrollCycle', 'employee']);

        return $this->success(
            (new PayslipResource($payslip))->toArray($request),
            'Payslip updated successfully.'
        );
    }

    public function destroy(Payslip $payslip)
    {
        $this->service->delete($payslip);

        return $this->success(null, 'Payslip deleted successfully.');
    }
}
