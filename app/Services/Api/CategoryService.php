<?php


namespace App\Services\Api;


use App\Models\Api\Category;

class CategoryService extends BaseService
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        $cat = Category::all();
        $cat = $this->generatePageTree($cat);

        return $cat;
    }

    /**
     * @param $datas
     * @param int $parent
     * @param int $depth
     * @return string
     */
    public function generatePageTree($datas, $parent = 0, $depth = 0)
    {
        $ni = count($datas);
        if ($ni === 0 || $depth > 1000) {
            return ''; // Make sure not to have an endless recursion
        }
        $tree = '<ul>';
        for ($i = 0; $i < $ni; $i++) {
            if ($datas[$i]['parent_id'] == $parent) {
                $tree .= '<li>';
                $tree .= $datas[$i]['name'];
                $tree .= $this->generatePageTree($datas, $datas[$i]['id'], $depth + 1);
                $tree .= '</li>';
            }
        }
        $tree .= '</ul>';
        return $tree;
    }
}
