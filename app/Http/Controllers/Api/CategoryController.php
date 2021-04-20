<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::all();

        if ($categories->count() < 1) {
            return response()->json(['result' => ['status' => 'error', 'message' => 'registros inexistentes']], 404);
        }

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:categories'
        ];

        $messages = [
            'name.required' => 'Nome é obrigatório',
            'name.unique' => 'Categoria já existe'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
            return response()->json(['result' => ['status' => 'error', 'message' => $validator->messages()]], 400);

        Category::create($request->all());

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro salvo com sucesso']]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category)
            return response()->json(['result' => ['status' => 'error', 'message' => 'categoria inexistente']], 404);

        $products = $category->products()->orderBy('id', 'ASC')->get();

        if ($products) {
            $response = [
                'category' => $category->name,
                'products' => $products
            ];
            return response()->json($response);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|unique:categories'
        ];

        $messages = [
            'name.required' => 'Nome é obrigatório',
            'name.unique' => 'Categoria já existe'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
            return response()->json(['result' => ['status' => 'error', 'message' => $validator->messages()]], 400);

        $category->name = $request->name;

        if(!$category->save())
            return response()->json(['result' => ['status' => 'error', 'message' => 'erro não esperado']], 500);

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro atualizado com sucesso']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $category = Category::find($id);

        if (!$category)
            return response()->json(['result' => ['status' => 'error', 'message' => 'registro inexistente']], 404);

        if (!$category->delete())
            return response()->json(['result' => ['status' => 'error', 'message' => 'erro não previsto']], 500);

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro excluído com sucesso']]);

    }
}
