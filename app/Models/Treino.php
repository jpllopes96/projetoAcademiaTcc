<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = [
        'treino',
        'series',
        'video',
        'repeticoes',
        'carga',
        'aluno_id',
        'user_id',
        'semana_dia_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function aluno()
    {
        return $this->belongsTo(User::class);
    }
    public function dia()
    {
        return $this->belongsTo(SemanaDias::class, 'semana_dia_id', 'id');
    }
   
}
