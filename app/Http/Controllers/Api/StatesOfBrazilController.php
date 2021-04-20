<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatesOfBrazil;
use App\Services\StatesOfBrazilService;
use Illuminate\Http\JsonResponse;

class StatesOfBrazilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $states = StatesOfBrazil::all();

        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        $service = new StatesOfBrazilService();
        $states = $service->getStates();

        try {
            foreach ($states as $state) {
                $statesOfBrazil = new StatesOfBrazil();
                $statesOfBrazil->id_origin = $state['id'];
                $statesOfBrazil->name = $state['nome'];
                $statesOfBrazil->uf = $state['sigla'];

                $statesOfBrazil->save();
            }

            return response()->json(['response' => ['status' => 'success', 'message' => 'estados salvos com sucesso']]);
        } catch(\Exception $e) {
            return response()->json(['response' => ['status' => 'error', 'message' => 'não foi possível salvar os registros', 'interal_message' => $e->getMessage()]], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $state = StatesOfBrazil::find($id);

        return response()->json($state);
    }
}
