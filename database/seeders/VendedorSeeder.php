<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendedor;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        // Defina o número de registros que você deseja inserir
        $quantidade = 10;

        for ($i = 0; $i < $quantidade; $i++) {
            // Escolha aleatoriamente entre 'CPF' e 'CNPJ'
            $tipoDocumento = (rand(0, 1) === 0) ? 'CPF' : 'CNPJ';

            Vendedor::create([
                'nome' => 'Test User ' . Str::random(5),
                'documento' => $this->gerarDocumento($tipoDocumento),
                'tipo_documento' => $tipoDocumento,
                'data_fechamento' => Carbon::now(),
            ]);
        }
    }

    /**
     * Gere um valor de documento baseado no tipo especificado.
     *
     * @param string $tipoDocumento
     * @return string
     */
    protected function gerarDocumento(string $tipoDocumento): string
    {
        if ($tipoDocumento === 'CNPJ') {
            return $this->gerarCNPJ();
        }
        return $this->gerarCPF();
    }

    /**
     * Gere um CNPJ fictício.
     *
     * @return string
     */
    protected function gerarCNPJ(): string
    {
        $cnpj = '';
        for ($i = 0; $i < 8; $i++) {
            $cnpj .= rand(0, 9);
        }
        $cnpj .= '0001';
        $cnpj .= rand(0, 9) . rand(0, 9); // Digitos verificadores simplificados
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }

    /**
     * Gere um CPF fictício.
     *
     * @return string
     */
    protected function gerarCPF(): string
    {
        $cpf = '';
        for ($i = 0; $i < 9; $i++) {
            $cpf .= rand(0, 9);
        }
        $cpf .= rand(0, 9) . rand(0, 9); // Digitos verificadores simplificados
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
}
