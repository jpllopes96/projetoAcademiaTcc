<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academia extends Model
{
    use HasFactory;

    protected $fillable = [
    'id',
    'nome',
    'descricao',
    'img_path',
    'endereco',
    'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
