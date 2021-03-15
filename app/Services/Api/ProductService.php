<?php


namespace App\Services\Api;


use App\Models\Api\Category;
use App\Models\Api\Product;

class ProductService extends BaseService
{
    /**
     * @var
     */
    public $ids;

    /**
     * @param $data
     * @return mixed
     */
    public function index($data, $characteristics)
    {
        if ($data['category_ids']) {
            $this->categoryIds($data['category_ids']);
        }
        $category_ids = $this->ids;
        $price = $data['price'] ?? null;
        $products = Product::when($category_ids, function ($query) use ($category_ids) {
            $query->whereHas("category", function ($query) use ($category_ids) {
                $query->whereIn("category_id", $category_ids);
            });
        })
            ->when($price, function ($query) use ($price) {
                $query->whereBetween('price', $price);
            })
            ->when(!empty($characteristics), function ($query) use ($characteristics, $data) {

                $query->whereHas("characteristics", function ($query) use ($characteristics, $data) {
                    foreach ($characteristics as $characteristic) {
                        if (!empty($data[$characteristic])) {
                            $array = collect($data[$characteristic])->map(function ($item) {
                                return (int)$item;
                            })->toArray();

                            $query->whereBetween("characteristic_product.value", $array);
                        }
                    }
                });
            })
            ->paginate(15);

        return $products;
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function productBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }

    /**
     * @param $category_ids
     * @return array
     */
    public function categoryIds($category_ids)
    {
        $catIds = Category::whereIn('parent_id', $category_ids);
        $cIds = $catIds->pluck('id')->toArray();

        if (!$catIds->where('level', 2)->first()) {
            $this->ids = array_merge($category_ids, $cIds);
            return array_merge($category_ids, $cIds);
        }
        $this->categoryIds($cIds);
    }
}
