<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // create usuários academia
        //cria 5 usuarios
        $userAcademias = \App\Models\User::factory(5)->create();
        foreach ($userAcademias as $userAcademia) {
            $academia = \App\Models\Academia::factory(1)->create([
                'user_id' => $userAcademia->id
            ]);
            $userAcademia->academia_id = $academia[0]->id;
            $userAcademia->created_at = date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s') . '- ' . rand(0, 6) . ' months'));
            $userAcademia->save();
            $userAcademia->givePermissionTo('academia');
            
        }
        
        // create usuários Professores
        $userProfessores = \App\Models\User::factory(20)->create();
        foreach ($userProfessores as $professor) {
            $professores = \App\Models\Professor::factory(1)->create([
                'user_id' => $professor->id,
                'academia_id' => mt_rand(1, 5)
            ]);  
            $professor->academia_id = $professores[0]->academia_id;
            $professor->created_at = date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s') . '- ' . rand(0, 6) . ' months'));
            $professor->save();
            $professor->givePermissionTo('professor');
            
        }

        // create usuários Alunos
        $userAlunos = \App\Models\User::factory(20)->create();
        foreach ($userAlunos as $aluno) {
            $alunos = \App\Models\Aluno::factory(1)->create([
                'user_id' => $aluno->id,
                'academia_id' => mt_rand(1, 5)
            ]);  
            $aluno->academia_id = $alunos[0]->academia_id;
            $aluno->created_at = date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s') . '- ' . rand(0, 6) . ' months'));
            $aluno->save();
            $aluno->givePermissionTo('aluno');
            
        }
        
    }
    
}