<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Aluno extends Model
{
    
    use HasFactory, HasRoles;

    protected $fillable = ['sexo', 'status', 'user_id', 'celular', 'cpf', 'data_nascimento', 'academia_id', 'id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function academia()
    {
        return $this->belongsTo(Academia::class);
    }
    //Dados para os graficos da estatistica
    protected $appends = [
        'mes',
        'idade'
    ];
    //Dados para os graficos da estatistica
    public function getMesAttribute()
    {
        $meses = ['', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        return $meses[$this->created_at->format('n')];
    }
    //retorna idade de acordo com data de nascimento para a estatistica
    public function getIdadeAttribute()
    {
        return Carbon::parse($this->data_nascimento)->diff(Carbon::now())->y;
    }

}

