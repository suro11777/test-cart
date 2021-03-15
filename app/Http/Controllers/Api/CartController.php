<?php


namespace App\Http\Controllers\Api;


use App\Models\Api\Cart;
use App\Models\Api\Order;
use App\Services\Api\CartService;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\This;


class CartController extends BaseController
{
    protected $cart;
    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->baseApiService = $cartService;
        $this->getCart();
    }

    /**
     * add product by id in cart
     */
    public function add(Request $request, $id)
    {
        $quantity = $request->get('quantity') ?? 1;
        $this->cart->plus($id, $quantity);

        return response()->json(['message' => 'product add by id-'.$id, 'cart_id'=> $this->cart->id],200);
    }

    /**
     * plus count product
     */
    public function plus($id)
    {
        $this->cart->plus($id);
        return response()->json(['message' => 'product plus by id-'.$id],200);
    }

    /**
     * minus count product
     */
    public function minus($id)
    {
        $this->cart->minus($id);
        return response()->json(['message' => 'product minus by id-'.$id],200);
    }

    /**
     * return object cart, if not found -create new
     */
    private function getCart()
    {
        $cart_id = request()->get('cart_id');

        if (!empty($cart_id)) {
            try {
                $this->cart = Cart::findOrFail($cart_id);
            } catch (ModelNotFoundException $e) {
                $this->cart = Cart::create();
            }
        } else {
            $this->cart = Cart::create();
        }

    }

    /**
     * delete product by id
     */
    public function remove($id)
    {
        $this->cart->remove($id);
        return response()->json(['message' => 'product delete by id-'.$id],200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveOrder(Request $request)
    {
        if (!auth()->check()){
            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:255',
            ]);
        }
        $data = $request->all();
        $this->getCart();

        $this->baseApiService->saveOrder($data, $this->cart);

        return response()->json(['message' => 'order create'],200);
    }


}
