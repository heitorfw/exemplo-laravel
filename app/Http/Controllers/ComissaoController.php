<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ComissaoRequest;

use App\Models\Vendedor;
use App\Models\Comissao;
use Illuminate\Http\JsonResponse;
use Exception;

class ComissaoController extends Controller
{
    public function index() : JsonResponse
    {
        $comissoes= Comissao::orderBy('id', 'ASC')->paginate(2);
        return response()->json([
            'status' => true,
            'contatos' => $comissoes,
        ], 200);
    }

    public function show(Comissao $comissao): JsonResponse
    {
        return response()->json([
            'status' => true,
            'contato' => $comissao,
        ], 200);
    }
    public function store(ComissaoRequest $request):JsonResponse    
    {
        DB::beginTransaction();
        try{  
            $comissao = Comissao::create([
                'porcentagem'=> $request->input('porcentagem'),
                'valor_fixo'=> $request->input('valor_fixo'),
                'nome' => $request->input('nome'),
                'data_inicio'=> $request->input('data_inicio'),
                'data_fim'=> $request->input('data_fim'),
                
                
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'comissao' => $comissao,
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
    public function update(ComissaoRequest $request, Comissao $comissao) 
    {
        DB::beginTransaction();
        try{
            

            $comissao->update([
                'porcentagem'=> $request->input('porcentagem'),
                'valor_fixo'=> $request->input('valor_fixo'),
                'nome' => $request->input('nome'),
                'data_inicio'=> $request->input('data_inicio'),
                'data_fim'=> $request->input('data_fim'),
                
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'vendedor' => $comissao,
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
    public function destroy(Comissao $comissao){
        try{
            $comissao->delete();
            return response()->json([
               'status' => true,
               'vendedor' => $comissao,
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