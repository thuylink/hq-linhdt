<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;

class OrderController extends Controller
{
    public function __construct(
        protected OrderService $orderService
    ) {}

    public function index()
    {
        $categories = $this->orderService->index();
        return response()->json(['data' => $categories]);
    }

    public function store(OrderRequest $orderRequest)
    {
        $validatedData = $orderRequest->validated();
        $order = $this->orderService->store($validatedData);
        return response()->json(['data' => $order], Response::HTTP_CREATED);
    }

    public function updateStatus(UpdateStatusRequest $updateStatusRequest, int $id)
    {
        $validatedData = $updateStatusRequest->validated();
        $order = $this->orderService->updateStatus($id, $validatedData);
        return response()->json([
            'data' => $order
        ], Response::HTTP_OK);
    }
    public function sendSMS()
    {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_TOKEN");
        $senderNumber = getenv("TWILIO_PHONE");

        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create(
            "+84379620802",
            [
                "body" => "msg đây",
                "from" => $senderNumber,
            ]
        );


        dd("Send sms ok");
        print $message->body;
    }
}
