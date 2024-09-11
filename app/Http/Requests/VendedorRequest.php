<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendedorRequest extends FormRequest
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
        // Obtenha o ID do vendedor da rota, se disponível
        $vendedorId = $this->route('vendedor'); 
        
        return [
            'nome' => 'required|string|max:255',
            'documento' => [
                'required',
                'string',
                'regex:/^\d{11}$|^\d{14}$/', 
                
                Rule::unique('vendedores', 'documento')->ignore($vendedorId),
            ],
            'tipo_documento' => 'required|string|in:CPF,CNPJ',
            'data_fechamento' => 'required|date',
            'contatos' => 'sometimes',
        ];
    }

    /**
     * Customize the error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.string' => 'O nome deve ser uma string.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'documento.required' => 'O documento é obrigatório.',
            'documento.string' => 'O documento deve ser uma string.',
            'documento.regex' => 'O formato do documento deve ter 11 ou 14 dígitos.',
            'documento.unique' => 'Este documento já está cadastrado.',
            'tipo_documento.required' => 'O tipo de documento é obrigatório.',
            'tipo_documento.string' => 'O tipo de documento deve ser uma string.',
            'tipo_documento.in' => 'O tipo de documento deve ser CPF ou CNPJ.',
            'data_fechamento.required' => 'A data de fechamento é obrigatória.',
            'data_fechamento.date' => 'A data de fechamento deve ser uma data válida.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json($validator->errors(), 422);

        throw new HttpResponseException($response);
    }
}
