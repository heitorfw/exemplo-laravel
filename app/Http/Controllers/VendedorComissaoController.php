<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VendedorComissaoRequest;

use App\Models\Vendedor;
use App\Models\Comissao;
use App\Models\VendedoresComissao;
use Illuminate\Http\JsonResponse;
use Exception;

class VendedorComissaoController extends Controller
{
   public function store(VendedorComissaoRequest $request){
            DB::beginTransaction();

            try{
                $dadosValidados = $request->validated();

                /*if (is_array($dadosValidados)) {
                    if(isset($dadosValidados['comissoes']) && isset($dadosValidados['vendedores'])){
                       
                            $teste=VendedoresComissao::where('telefone', $contatoData['telefone'])->exists();
                            if ($teste) {
                                DB::rollBack();
                                return response()->json([
                                    'status' => false,
                                    'message' => 'Contato com telefone ' . $contatoData['telefone'] . ' já existe.',
                                ], 409);
                            }
                            VendedoresComissao::create([
                           
                               'ativo' => true,
                            ]);
    
                        
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
                    'vendedorComissao' => $VendedorComissao,
                    'message' => 'novo registro inserido com sucesso!',
                ], 200);

*/
            }catch(Exception $e)
            {

            }
   }
}