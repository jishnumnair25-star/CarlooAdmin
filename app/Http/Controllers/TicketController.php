<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class TicketController extends Controller
{
    protected $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $filters = $request->only(['search', 'status_opened', 'status_closed']);
            $tickets = $this->ticketService->getTickets($filters);
            
            return response()->json([
                'status' => 'success',
                'data' => $tickets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving tickets'
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $ticket = $this->ticketService->createTicket(
                $request->all(),
                $request->file('attachments', [])
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Department not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the ticket'
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $ticket = $this->ticketService->getTicket($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $ticket
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving the ticket'
            ], 500);
        }
    }

    public function reply(Request $request, $id): JsonResponse
    {
        try {
            $reply = $this->ticketService->replyToTicket(
                $id,
                $request->all(),
                $request->file('attachments', [])
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Reply sent successfully',
                'data' => $reply
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while sending the reply'
            ], 500);
        }
    }

    public function downloadAttachment($ticketId, $attachmentId)
    {
        try {
            return $this->ticketService->downloadAttachment($ticketId, $attachmentId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket or attachment not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while downloading the attachment'
            ], 500);
        }
    }

    public function departments(): JsonResponse
    {
        try {
            $departments = Department::active()->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $departments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while retrieving departments'
            ], 500);
        }
    }
} 