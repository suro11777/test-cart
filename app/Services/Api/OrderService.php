<?php


namespace App\Services\Api;


use App\Models\Api\Order;

class OrderService extends BaseService
{

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAllOrders()
    {
        $user_id = auth()->id()??null;

        if (!$user_id){
            throw new \Exception( 'unauthorized', 401);
        }
        return Order::with('order_products')->where('user_id', $user_id)->paginate(15);
    }
}
