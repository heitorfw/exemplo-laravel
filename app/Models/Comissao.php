<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comissao extends Model
{
    use HasFactory;

    // Defina o nome da tabela se não seguir a convenção plural do Laravel
    protected $table = 'vendedores';

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'porcentagem',
        'valor_fixo',
        'data_inicio',
        'data_fim',
    ];

    // Defina os campos que são casted para tipos específicos
    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    
}
