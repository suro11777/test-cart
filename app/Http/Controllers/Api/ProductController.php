<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\CharacteristicService;
use App\Services\Api\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    /**
     * @var CharacteristicService
     */
    protected $characteristicService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     * @param CharacteristicService $characteristicService
     */
    public function __construct(ProductService $productService, CharacteristicService $characteristicService)
    {
        $this->baseApiService = $productService;
        $this->characteristicService = $characteristicService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function products(Request $request)
    {
        $characteristics = $this->characteristicService->getAll();
        foreach ($characteristics as $characteristic){
            $validateData[$characteristic] = 'nullable|array';
        }

        $this->validate($request, array_merge($validateData,[
            'category_ids' => 'nullable|array|exists:categories,id',
            'price' => 'nullable|array',
        ]));
        $data = $request->all();

        $products = $this->baseApiService->index($data, $characteristics);
        return response()->json(['status' => 200, 'data' => $products]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function productBySlug($slug)
    {
        $product = $this->baseApiService->productBySlug($slug);
        return response()->json(['status' => 200, 'data' => $product, 'message' => 'product not found by slug']);
    }
}
