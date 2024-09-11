<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class VendedorComissaoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
        $vendedorId = $this->route('vendedor'); 
        $comissaoId = $this->route('comissao');
        
        return [
            'ativo' => 'required',
            'vendedores' => 'sometimes',
            'contatos' => 'sometimes',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json($validator->errors(), 422);

        throw new HttpResponseException($response);
    }
    public function messages()
        {
            return [
                'comissao_id.exists' => 'a comissão especificado não existe.',
                'ativo.required' => 'campo ativo é obrigatório',
                'vendedor_id.exists' => 'O vendedor especificado não existe.',
            ];
        }


}
