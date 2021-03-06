<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->filled('search')) {
                $product = Product::PesquisaPorNome($request->search);
                return response()->json($product);
            }
            if ($request->filled('limit')) {
                $product = Product::all();
                return response()->json(['data' => $product]);
            }

            $product = Product::paginate(config('app.pageLimit'));
            return response()->json($product);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request,  Product $product)
    {
        try {
            $result = $product::create($request->all());

            return response()->json([
                'data' => $result,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product, $id)
    {
        try {
            $product->find($id)->update($request->all());

            return response()->json([
                'message' => 'Produto atualizado com sucesso!',
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id, Product $product)
    {
        try {
            return response()->json($product->where('id', $id)->get()[0], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Product $product)
    {
        try {
            $products = $product->find($id);
            $products->delete();

            return response()->json([
                'message' => $products->nome . ' exclu??do(a) com sucesso!',
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
