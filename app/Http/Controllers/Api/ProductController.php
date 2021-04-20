<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


/**
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $products = Product::all();

        if ($products->count() < 1)
            return response()->json(['result' => ['status' => 'error', 'message' => 'registros inexistentes']], 404);

        foreach ($products as $product)
            $product->category_name = $product->category()->get()->first()->name;

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // TODO campos nulos declara nullable
        $rules = [
            'name' => 'required|unique:products',
            'category' => 'required',
            'price' => 'required|numeric'
        ];

        $messages = [
            'category.required' => 'ID da categoria é obrigatório',
            'name.required' => 'Nome do produto é obrigatório',
            'name.unique' => 'Produto já existe',
            'price.required' => 'Preco do produto é obrigatório',
            'price.numeric' => 'Preco do produto deve ser numeros',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return response()->json(['result' => ['status' => 'error', 'message' => $validator->messages()]], 404);

        if (!$this->categoryExist($request->category))
            return response()->json(['result' => ['status' => 'error', 'message' => 'categoria inexistente']], 404);

        Product::create($request->all());

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro salvo com sucesso']]);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['result' => ['status' => 'error', 'message' => 'produto inexistente']], 404);

        $product->category_name = $product->category()->get()->first()->name;

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse
    {
        $rules = [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'numeric',
        ];

        $messages = [
            'category.required' => 'Categoria é necessária'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails())
            return response()->json($validator->messages(), 400);

        if (!$this->categoryExist($request->category))
            return response()->json(['result' => ['status' => 'error', 'message' => 'categoria inexistente']], 404);

        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if(!$product->save())
            return response()->json(['result' => ['status' => 'error', 'message' => 'erro não esperado']], 500);

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro atualizado com sucesso']]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product)
            return response()->json(['result' => ['status' => 'error', 'message' => 'registro inexistente']], 404);

        if (!$product->delete())
            return response()->json(['result' => ['status' => 'error', 'message' => 'erro não previsto']], 500);

        return response()->json(['result' => ['status' => 'success', 'message' => 'registro excluído com sucesso']]);
    }


    /**
     * @param int $category_id
     * @return bool
     */
    private function categoryExist(int $category_id): bool
    {
        $category = Category::find($category_id);

        if (!$category)
            return false;

        return true;
    }
}
