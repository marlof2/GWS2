<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;

class ClientController extends Controller
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
                $client = Client::PesquisaPorNome($request->search);
                return response()->json($client);
            }

            if ($request->filled('limit')) {
                $client = Client::all();
                return response()->json(['data' => $client]);
            }

            $client = Client::paginate(config('app.pageLimit'));
            return response()->json($client);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request, Client $client)
    {
        try {
            $result = $client::create($request->all());

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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id, Client $client)
    {
        try {
            return response()->json($client->where('id', $id)->get()[0], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, $id, Client $client)
    {
        try {
            $client->find($id)->update($request->all());

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Client $client)
    {
        try {
            $products = $client->find($id);
            $products->delete();

            return response()->json([
                'message' => $client->nome . ' excluído(a) com sucesso!',
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
