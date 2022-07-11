<?php

namespace App\Http\Controllers;

use App\Models\Programation;
use App\Http\Requests\StoreProgramationRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Requests\UpdateProgramationRequest;
use App\Models\Product;
use App\Models\ProgramationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramationController extends Controller
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
                $programation = Programation::PesquisaPorNome($request->search);
                return response()->json($programation);
            }

            $programation = Programation::with('cliente', 'condominio', 'user')->paginate(config('app.pageLimit'));
            return response()->json($programation);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramationRequest $request)
    {

        try {
            $programation = Programation::create($request->all());

            return response()->json([
                'data' => $programation,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {

            $programation = Programation::where('id', $id)->with('cliente', 'condominio', 'user', 'produtos')->get();
            return response()->json($programation);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramationRequest  $request
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateClientRequest $request)
    {
        try {
            Programation::find($id)->update($request->all());

            return response()->json([
                'message' => 'Programação atualizado com sucesso!',
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = new Product();
            $procuctsForExclude =  ProgramationProduct::whereProgramationId($id)->get();

            DB::beginTransaction();
            foreach ($procuctsForExclude as  $value) {

                $data = [
                    'product_id' => $value->product_id,
                    'quantidade' => $value->quantidade
                ];

                $product->adicionaNoEstoque(null, $data);

                $deleteProducts =  ProgramationProduct::whereProgramationId($id)->delete();
            }

            Programation::find($id)->delete();

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
