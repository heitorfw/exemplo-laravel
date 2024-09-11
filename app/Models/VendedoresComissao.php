<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendedoresComissao extends Model
{
    use HasFactory;

    protected $table = 'vendedoresComissao';
    protected $fillable = [
        'ativo',
        'comissao_id',
        'vendedor_id',
        'comissoes',
        'vendedores',
        'comissoes',
    ];


}
