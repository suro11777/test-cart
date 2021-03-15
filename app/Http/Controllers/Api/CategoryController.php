<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\CategoryService;

class CategoryController extends BaseController
{
    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->baseService = $categoryService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $cat = $this->baseService->getAll();
        return response()->json(['status' => 200, 'data' => $cat]);
    }
}
