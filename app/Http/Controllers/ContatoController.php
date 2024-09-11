<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ContatoRequest;
use App\Models\Contato;
use App\Models\Vendedor;
use COM;
use Illuminate\Http\JsonResponse;
use Exception;

class ContatoController extends Controller
{
    public function index() : JsonResponse
    {
        $contatos = Contato::orderBy('id', 'ASC')->paginate(2);
        return response()->json([
            'status' => true,
            'contatos' => $contatos,
        ], 200);
    }

    public function show(Contato $contato): JsonResponse
    {
        return response()->json([
            'status' => true,
            'contato' => $contato,
        ], 200);
    }
    public function store(ContatoRequest $request, Contato $contato):JsonResponse    
    {
        DB::beginTransaction();
        try{
                
                $vendedorId = $request->input('vendedor_id');

            // Verifique se o vendedor com o ID fornecido existe
            $vendedorExists = Vendedor::find($vendedorId);
            if (!$vendedorExists) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vendedor não encontrado.',
                ], 404);
            }
            $contato = Contato::create([
                'telefone'=> $request->input('telefone'),
                'email'=> $request->input('email'),
                'nome' => $request->input('nome'),
                'cargo'=> $request->input('cargo'),
                'vendedor_id' => $vendedorId,
                
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'vendedor' => $contato,
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
    public function update(ContatoRequest $request, Contato $contato) 
    {
        DB::beginTransaction();
        try{
            $vendedorId = $request->input('vendedor_id');

            // Verifique se o vendedor com o ID fornecido existe
            $vendedorExists = Vendedor::find($vendedorId);
            if (!$vendedorExists) {
                return response()->json([
                    'status' => false,
                    'message' => 'Vendedor não encontrado.',
                ], 404);
            }

            $contato->update([
                'telefone'=> $request->input('telefone'),
                'email'=> $request->input('email'),
                'nome' => $request->input('nome'),
                'cargo'=> $request->input('cargo'),
                'vendedor_id' => $vendedorId,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'vendedor' => $contato,
                'message' => 'registro editado com sucesso!',
            ], 200);
        }catch(Exception $e){
            DB::rollBack();
            
            return response()->json([
                'status' => false,
                'message' => 'novo registro não editado' . $e->getMessage(),
            ], 400);
        }
        
    }
    public function destroy(Contato $contato){
        try{
            $contato->delete();
            return response()->json([
               'status' => true,
               'vendedor' => $contato,
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