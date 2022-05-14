<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Meta;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;

class RelatorioController extends Controller
{
    public function index()
    {
        return view('relatorio.index');
    }

    
}
