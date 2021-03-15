<?php


namespace App\Http\Controllers\Api;


use App\Services\Api\CharacteristicService;
use Illuminate\Http\Request;

class CharacteristicController extends BaseController
{
    public function __construct(CharacteristicService $characteristicService)
    {
        $this->baseApiService = $characteristicService;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);
        $characteristic = $this->baseApiService->store($request->only('name'));

        return response()->json(['data'=> $characteristic], 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
        ]);
        $characteristic = $this->baseApiService->update($request->only('name'), $id);

        if (!$characteristic){
            return response()->json(['data' => [],'message' => 'characteristic not found this id'], 404);
        }

        return response()->json(['data'=> $characteristic], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $deleted = $this->baseApiService->delete($id);
        if (!$deleted){
            return response()->json(['message' => 'characteristic not delete'], 500);
        }

        return response()->json(['message' => 'characteristic delete'], 200);
    }
}
