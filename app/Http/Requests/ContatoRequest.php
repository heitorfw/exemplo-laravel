<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
class ContatoRequest extends FormRequest
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
            'telefone' => 'required|string|max:15',
            'email' => 'required|email|exists:contato.email',
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'vendedor_id' => 'required|exists:vendedores,id',
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
                'telefone.required' => 'O campo telefone é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'nome.required' => 'O campo nome é obrigatório.',
                'cargo.required'=> 'O campo cargo é obrigatório',
                'vendedor_id.exists' => 'O vendedor especificado não existe.',
            ];
        }


}
