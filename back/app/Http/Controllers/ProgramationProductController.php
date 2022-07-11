<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramationProductsRequest;
use App\Models\Product;
use App\Models\ProgramationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramationProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $programationProduct = ProgramationProduct::all();
            return response()->json($programationProduct);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramationProductsRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $programacaoProduto = ProgramationProduct::create($request->all());

            if ($programacaoProduto) {
                $product->retiraDoEstoque($programacaoProduto, $product);
            }

            DB::commit();
            return response()->json([
                'data' => $programacaoProduto,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // try {

        //     $programationProduct = ProgramationProduct::get();
        //     return response()->json($programationProduct);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => $e->getMessage(),
        //     ], 406);
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        try {
            DB::beginTransaction();
            $programacaoProduto = ProgramationProduct::whereProgramationId($id)->whereProductId($request->product_id)->get();
            $quantAnterior = $programacaoProduto[0]->quantidade;


            if ($quantAnterior != $request->quantidade) {
                $product->adicionaNoEstoque($quantAnterior, $request->all());
                $product->retiraDoEstoque($request->all());
            }

            $programacaoProduto = ProgramationProduct::whereProgramationId($id)
                ->whereProductId($request->product_id)->update([
                    'programation_id' => $request->programation_id,
                    'product_id' => $request->product_id,
                    'quantidade' => $request->quantidade,
                ]);

            DB::commit();
            return response()->json([
                'message' => 'Produto atualizado com sucesso!',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();

            $product->adicionaNoEstoque(null, $request->all());

            ProgramationProduct::whereProgramationId($request->programation_id)
                ->whereProductId($request->product_id)->delete();

            DB::commit();
            return response()->json([
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
