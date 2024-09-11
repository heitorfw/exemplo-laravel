<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContatoRequest;
use App\Models\Vendedor;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VendedorRequest;
use App\Models\Contato;

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
            
            
            $request->validated();
            $vendedor = Vendedor::create([
                'nome' => $request->input('nome'),
                'documento' => $request->input('documento'),
                'tipo_documento' => $request->input('tipo_documento'),
                'data_fechamento' => $request->input('data_fechamento'),
            ]);
            $dadosValidados = $request->validated();

            if (is_array($dadosValidados)) {
                if(isset($dadosValidados['contatos'])){
                    foreach ($dadosValidados['contatos'] as $contatoData) {
                        $teste=Contato::where('telefone', $contatoData['telefone'])->exists();
                        if ($teste) {
                            DB::rollBack();
                            return response()->json([
                                'status' => false,
                                'message' => 'Contato com telefone ' . $contatoData['telefone'] . ' já existe.',
                            ], 409);
                        }
                        Contato::create([
                            'telefone' => $contatoData['telefone'],
                            'email' => $contatoData['email'],
                            'nome' => $contatoData['nome'],
                            'cargo' => $contatoData['cargo'],
                            'vendedor_id' => $vendedor->id, 
                        ]);

                    }
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'parametros não validados' ,
                ], 404);
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'contatos' => $dadosValidados['contatos'] ,
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
                'message' => 'novo registro não editado' . $e->getMessage(),
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