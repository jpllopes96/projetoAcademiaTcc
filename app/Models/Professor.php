<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professores';
    //Dados para os graficos da estatistica
    protected $appends = [
        'mes',
    ];
    protected $fillable =[
        'nome',
        'user_id',
        'academia_id',
        'celular'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function academia()
    {
        return $this->belongsTo(Academia::class);
    }
    //Dados para os graficos da estatistica
    public function getMesAttribute()
    {
        $meses = ['', 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        return $meses[$this->created_at->format('n')];
    }
   
}
