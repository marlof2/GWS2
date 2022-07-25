<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentoRequest;
use App\Models\Documents;
use App\Models\ProgramationDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $documents = Documents::paginate(config('app.pageLimit'));
            return response()->json($documents);
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
    public function store(StoreDocumentoRequest $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();
            $file = $inputs['file'];

            if ($file->isValid()) {
                $path =  $file->store('images', 'public');
                $file = $inputs['file'] = $path;
            }

            $document = Documents::create($inputs);

            if ($document) {
                $programationDocuments = [
                    'documents_id' => $document->id,
                    'programation_id' => $inputs['programation_id']
                ];

                ProgramationDocuments::create($programationDocuments);
            }

            DB::commit();
            return response()->json([
                'data' => $document,
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
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function show(Documents $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documents $documents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documents  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Documents $documents)
    {
        try {
            $document = $documents->find($id);
            $document->delete();
            Storage::disk('public')->delete($document->file);

            return response()->json([
                'status' => '200'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    public function downloadFile($id, Documents $documents)
    {
        try {

            $document = $documents->find($id);
            $exists = Storage::disk('public')->exists($document->file);
            
            if ($exists) {
                return Storage::download('public/'.$document->file);
            }
            
            // $documentForDonwload = Storage::disk('public')->get($document->file);   
            // $url = Storage::url('app/public/' . $document->file);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 406);
        }
    }
}
