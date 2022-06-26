<?php

namespace Database\Seeders;

use App\Models\SemanaDias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiasDaSemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'id' => 1,
                'dia' => 'Segunda-feira'
            ], [
                'id' => 2,
                'dia' => 'Terça-feira'
            ], [
                'id' => 3,
                'dia' => 'Quarta-feira'
            ], [
                'id' => 4,
                'dia' => 'Quinta-feira'
            ], [
                'id' => 5,
                'dia' => 'Sexta-feira'
            ], [
                'id' => 6,
                'dia' => 'Sábado'
            ], [
                'id' => 7,
                'dia' => 'Domingo'
            ]
        ];
        SemanaDias::insert($data);
    }
}
