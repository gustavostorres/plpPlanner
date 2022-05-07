<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarefa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'statusTarefa', 'data', 'titulo', 'nomeTarefa', 'categoria_id', 'user_id', 'horarioFim', 'horarioInicio'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function metas(){
        return $this->belongsToMany(Meta::class, 'tarefaMeta');
    }

}
