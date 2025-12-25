<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Tickets\StoreTicketRequest;
use App\Http\Requests\Api\Tickets\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends ApiController
{
    public function __construct(private TicketService $service)
    {
        $this->authorizeResource(Ticket::class, 'ticket');
    }

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 15);
        $tickets = $this->service->paginateWith(['user', 'type'], $perPage);

        $data = $this->paginatedResponse(
            $tickets,
            collect(TicketResource::collection($tickets)->toArray($request))
        );

        return $this->success($data, 'Tickets retrieved successfully.');
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->service->create($request->validated());
        $ticket->load(['user', 'type']);

        return $this->success(
            (new TicketResource($ticket))->toArray($request),
            'Ticket created successfully.',
            Response::HTTP_CREATED
        );
    }

    public function show(Request $request, Ticket $ticket)
    {
        $ticket->load(['user', 'type']);

        return $this->success(
            (new TicketResource($ticket))->toArray($request),
            'Ticket retrieved successfully.'
        );
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket = $this->service->update($ticket, $request->validated());
        $ticket->load(['user', 'type']);

        return $this->success(
            (new TicketResource($ticket))->toArray($request),
            'Ticket updated successfully.'
        );
    }

    public function destroy(Ticket $ticket)
    {
        $this->service->delete($ticket);

        return $this->success(null, 'Ticket deleted successfully.');
    }
}
