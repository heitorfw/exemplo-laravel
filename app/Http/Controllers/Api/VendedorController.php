<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendedor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VendedorRequest;

class VendedorController extends Controller
{
    public function index() : JsonResponse{
        $vendedores = Vendedor::orderBy('id', 'DESC')->paginate(2);
        return response()->json([
            'status' => true,
            'vendedores' => $vendedores,
        ], 200);
    }

    public function show(Vendedor $vendedor): JsonResponse
    {
        return response()->json([
            'status' => true,
            'vendedor' => $vendedor,
        ], 200);
    }

    public function store(VendedorRequest $request):JsonResponse    
    {
        DB::beginTransaction();
        try{
            $vendedor = Vendedor::create([
                'nome' => $request->input('nome'),
                'documento' => $request->input('documento'),
                'tipo_documento' => $request->input('tipo_documento'),
                'data_fechamento' => $request->input('data_fechamento'),
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'vendedor' => $vendedor,
                'message' => 'novo registro inserido com sucesso!',
            ], 200);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'novo registro não inserido' . $e->getMessage(),
            ], 400);
        }
    }

    public function update(VendedorRequest $request, Vendedor $vendedor) 
    {
        DB::beginTransaction();
        try{
            $vendedor->update([
                'nome' => $request->input('nome'),
                'documento' => $request->input('documento'),
                'tipo_documento' => $request->input('tipo_documento'),
                'data_fechamento' => $request->input('data_fechamento'),
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'vendedor' => $vendedor,
                'message' => 'registro editado com sucesso!',
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'novo registro não inserido' . $e->getMessage(),
            ], 400);
        }
        
    }
   public function destroy(Vendedor $vendedor){
        try{
            $vendedor->delete();
            return response()->json([
               'status' => true,
               'vendedor' => $vendedor,
               'message' => 'Registro deletado com sucesso!',
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'error' => 'Ocorreu um erro ao deletar o registro.',
            ], 400);
    
    }
  }
}