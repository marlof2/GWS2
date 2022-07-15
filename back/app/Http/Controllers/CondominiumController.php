<?php

namespace App\Http\Controllers;

use App\Http\Requests\CondominiumRequest;
use App\Models\Condominium;
use Illuminate\Http\Request;

class CondominiumController extends Controller
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
                $condominium = Condominium::PesquisaPorNome($request->search);
                return response()->json($condominium);
            }

            if ($request->filled('limit')) {
                $condominium = Condominium::all();
                return response()->json(['data' => $condominium]);
            }


            $condominium = Condominium::paginate(config('app.pageLimit'));
            return response()->json($condominium);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CondominiumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CondominiumRequest $request, Condominium $condominium)
    {
        try {
            $result = $condominium::create($request->all());

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
     * Display the specified resource.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function show($id, Condominium $condominium)
    {
        try {
            return response()->json($condominium->where('id', $id)->get()[0], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CondominiumRequest  $request
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function update(CondominiumRequest $request, Condominium $condominium, $id)
    {
        try {
            $condominium->find($id)->update($request->all());

            return response()->json([
                'message' => 'Condominio atualizado com sucesso!',
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
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Condominium $condominium)
    {
        try {
            $condominios = $condominium->find($id);
            $condominios->delete();

            return response()->json([
                'message' => $condominios->nome . ' excluído(a) com sucesso!',
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
