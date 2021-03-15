<?php


namespace App\Services\Api;


use App\Models\Api\Characteristic;

class CharacteristicService extends BaseService
{
    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $characteristic = Characteristic::create($data);
        return $characteristic;
    }

    /**
     * @param $data
     * @param $product
     * @return mixed
     */
    public function update($data, $id)
    {
        $characteristic = Characteristic::find($id, ['id', 'name']);
        if (!$characteristic){
            return false;
        }

        $characteristic->name = $data['name'];
        $characteristic->save();
        return $characteristic;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return Characteristic::destroy($id);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Characteristic::all('name')->pluck('name');
    }
}
