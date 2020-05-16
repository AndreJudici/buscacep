<?php

require_once("vendor/autoload.php");

use AndreJudici\BuscaDadosCep\BuscaDadosCep;


$busca = new BuscaDadosCep();
$dados = $busca->getDadosCep('13505-550', BuscaDadosCep::API_WEBMANIABR, '3YbQ8BTNxA145ejKfVei8LIugn3A8iJa', 'XbZlf91aF7wc8BLVCpsvxfSC0nGaFaw3AQstD8ZqtTh6iuN0');
print_r($dados);