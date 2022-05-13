<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nomeCategoria', 'cor'
    ];

    public function tarefas(){
        return $this->hasMany(Tarefa::class, 'categoria_id');
    }

    public function metas(){
        return $this->hasMany(Tarefa::class, 'categoria_id');
    }
}
