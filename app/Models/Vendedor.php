<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    // Defina o nome da tabela se não seguir a convenção plural do Laravel
    protected $table = 'vendedores';

    // Defina os campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'documento',
        'tipo_documento',
        'data_fechamento',
    ];

    // Defina os campos que são casted para tipos específicos
    protected $casts = [
        'data_fechamento' => 'date',
    ];
}
