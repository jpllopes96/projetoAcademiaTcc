<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemanaDias extends Model
{
    use HasFactory;

    protected $fillable = ['dia'];

    public function treinos()
    {
        return $this->hasMany(Treino::class);
    }
}
