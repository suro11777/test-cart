<?php


namespace App\Services\Api;


use App\Models\Api\Cart;
use App\Models\Api\Order;


class CartService extends BaseService
{

    /**
     * @param $data
     * @param $cart
     */
    public function saveOrder($data, $cart)
    {
        $user = auth()->check() ? auth()->user() : null;
        $data['user_id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['phone'] = $user->phone;
        $data['amount'] = $cart->getAmount();
        $order = Order::create($data);

        foreach ($cart->order_products as $product) {
            $order->order_products()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }

        //delete cart
        $cart->delete();
    }
}
