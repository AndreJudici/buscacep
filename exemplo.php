<?php

 declare(strict_types=1);

require_once "vendor/autoload.php";

use AndreJudici\BuscaDadosCep\BuscaDadosCep;

$busca = new BuscaDadosCep();
$dados = $busca->getDadosCep('13505550', BuscaDadosCep::API_CEPLA);

print_r($dados);