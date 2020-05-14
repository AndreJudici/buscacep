<?php

require_once("vendor/autoload.php");

use AndreJudici\BuscaDadosCep\BuscaDadosCep;

$busca = new BuscaDadosCep();
$dados = $busca->getDadosCep('13505-550');
print_r($dados);