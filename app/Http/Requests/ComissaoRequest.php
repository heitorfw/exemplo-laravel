<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class ComissaoRequest extends FormRequest
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
        
        return [
            'porcentagem' => 'required|numeric|min:0',
            'valor_fixo' => 'required|numeric|min:0',
            'nome' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date',
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
                'data_inicio.required' => 'O campo telefone é obrigatório.',
                'data_fim.required' => 'O campo email é obrigatório.',
                'nome.required' => 'O campo nome é obrigatório.',
                'porcentagem.required'=> 'O campo cargo é obrigatório',
                'valor_fixo.required' => 'O vendedor especificado não existe.',
            ];
        }


}
