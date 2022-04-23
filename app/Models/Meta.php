<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'statusMeta', 'quantidadeTarefa', 'dataMeta', 'nomeMeta', 'categoria_id'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function tarefas(){
        return $this->belongsToMany(Tarefa::class, 'tarefaMeta');
    }
}
