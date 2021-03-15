<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\OrderService;

class OrderController extends BaseController
{
    /**
     * OrderController constructor.
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->baseApiService = $orderService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function getAllOrders()
    {
        $orders = $this->baseApiService->getAllOrders();
        return response()->json(['message' => 'all orders', 'data' => $orders], 200);
    }
}
