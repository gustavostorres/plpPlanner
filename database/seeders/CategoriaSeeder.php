<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Saúde'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Esportes'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Lazer'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Estudo'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Trabalho'
        ]);
    }
}
