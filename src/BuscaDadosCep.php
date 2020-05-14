<?php

namespace AndreJudici\BuscaDadosCep;

class BuscaDadosCep 
{
   private $url = "https://viacep.com.br/ws/";

   public function getDadosCep(string $cep): array
   {
        $cep = str_replace('-', '', $cep); 
        $dados = file_get_contents($this->url . "$cep/json");
        return json_decode($dados, true);
   }
}