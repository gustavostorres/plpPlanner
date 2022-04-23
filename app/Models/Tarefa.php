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
        'statusTarefa','turno', 'titulo', 'dataTarefa', 'nomeTarefa'
    ];

}
