<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramationDocumentoRequest;
use App\Models\ProgramationDocuments;
use Illuminate\Http\Request;

class ProgramationDocumentsController extends Controller
{
    public function index()
    {
        try {

            $documents = ProgramationDocuments::paginate(config('app.pageLimit'));
            return response()->json($documents);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }


    public function store(StoreProgramationDocumentoRequest $request)
    {
        try {
            $document = ProgramationDocuments::create($request->all());

            return response()->json([
                'data' => $document,
                'status' => true
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
    }
}
