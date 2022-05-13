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
            'nomeCategoria'=> 'Saúde',
            'cor'=> '#ffebcd'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Esportes',
            'cor'=> '#f08080'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Lazer',
            'cor'=> '#87cefa'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Estudo',
            'cor'=> '#c8a2c8'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Trabalho',
            'cor'=> '#e4f1cb'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Ligações importantes',
            'cor'=> '#d4e3eb'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Reuniões',
            'cor'=> '#eac3f9'
        ]);
        DB::table('categorias')->insert([
            'nomeCategoria'=> 'Compras',
            'cor'=> '#ffffff'
        ]);
    }
}
