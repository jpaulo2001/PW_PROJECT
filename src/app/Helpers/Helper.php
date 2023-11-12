<?php

namespace App\Helpers;

class Helper
{
    public static function departmentName() {
        $departments = [
            'Marketing',
            'Recursos Humanos',
            'Tecnologia da Informação',
            'Contabilidade',
            'Atendimento ao Cliente',
            'Logística',
            'Produção',
            'Pesquisa e Desenvolvimento'
        ];
        return $departments[array_rand($departments)];
    }

}
