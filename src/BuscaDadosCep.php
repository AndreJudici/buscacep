<?php

namespace AndreJudici\BuscaDadosCep;

class BuscaDadosCep 
{
   const API_VIACEP = "https://viacep.com.br/ws/";
   const API_CEPLA = "http://cep.la/";
   const API_APICEP = "https://ws.apicep.com/cep/";
   const API_WEBMANIABR = "https://webmaniabr.com/api/1/cep/";

   private function getDadosCep_ViaCep(string $cep): array
   {        
        $dados = file_get_contents(BuscaDadosCep::API_VIACEP."$cep/json");
        return json_decode($dados, true);
   }

   private function getDadosCep_ApiCep(string $cep): array
   {        
        $dados = file_get_contents(BuscaDadosCep::API_APICEP."$cep.json");
        return json_decode($dados, true);
   }

   private function getDadosCep_CepLa(string $cep)
   {
      $opts = [
         "http" => [
             "method" => "GET",
             "header" => "Accept: application/json\r\n"
         ]
     ];
     
     $context = stream_context_create($opts);
     
     $dados = file_get_contents(BuscaDadosCep::API_CEPLA.$cep, false, $context);
     return json_decode($dados, true);     
   }

   private function getDadosCep_WebManiaBr(string $cep, string $appKey, string $appSecret)
   {
      $opts = [
         "http" => [
             "method" => "GET",
             "header" => "Accept: application/json\r\n"
         ]
     ];
     
     $context = stream_context_create($opts);
     
     $dados = file_get_contents(BuscaDadosCep::API_WEBMANIABR.$cep."/?app_key=$appKey&app_secret=$appSecret", false, $context);
     return json_decode($dados, true);     
   }

   public function getDadosCep(string $cep, string $api = BuscaDadosCep::API_VIACEP, string $appKey = '', string $appSecret = ''): DadosCep
   {
      $cep = str_replace('-', '', $cep); 
      $dadosCep = new DadosCep();

      switch ($api) {
         case BuscaDadosCep::API_VIACEP:
            $dados = $this->getDadosCep_ViaCep($cep);
            if (isset($dados['cep'])) 
               $dadosCep->setCep($dados['cep']); 
            if (isset($dados['localidade']))
               $dadosCep->setCidade($dados['localidade']);
            if (isset($dados['uf']))
               $dadosCep->setUf($dados['uf']);
            if (isset($dados['bairro']))
               $dadosCep->setBairro($dados['bairro']);
            if (isset($dados['logradouro']))
               $dadosCep->setLogradouro($dados['logradouro']);
            if (isset($dados['complemento']))
               $dadosCep->setComplemento($dados['complemento']);
            if (isset($dados['unidade']))
               $dadosCep->setUnidade($dados['unidade']);
            if (isset($dados['ibge']))
               $dadosCep->setIbge((int) $dados['ibge']);
            if (isset($dados['gia']))
               $dadosCep->setGia((int) $dados['gia']);
            break;

         case BuscaDadosCep::API_CEPLA:
               $dados = $this->getDadosCep_CepLa($cep);
               if (isset($dados['cep']))
                  $dadosCep->setCep($dados['cep']);
               if (isset($dados['uf']))
                  $dadosCep->setUf($dados['uf']);
               if (isset($dados['cidade']))
                  $dadosCep->setCidade($dados['cidade']);
               if (isset($dados['bairro']))
                  $dadosCep->setBairro($dados['bairro']);
               if (isset($dados['logradouro']))
                  $dadosCep->setLogradouro($dados['logradouro']);
               break;

         case BuscaDadosCep::API_APICEP:
            $dados = $this->getDadosCep_ApiCep($cep);
            if (isset($dados['code']))
               $dadosCep->setCep($dados['code']);
            if (isset($dados['state']))
               $dadosCep->setUf($dados['state']);
            if (isset($dados['city']))
               $dadosCep->setCidade($dados['city']);
            if (isset($dados['district']))
               $dadosCep->setBairro($dados['district']);
            if (isset($dados['address']))
               $dadosCep->setLogradouro($dados['address']);
            break;

         case BuscaDadosCep::API_WEBMANIABR:

            if (!$appKey)
               throw new Exception("AppKey deve ser informada.", 1);

            if (!$appSecret)
               throw new Exception("AppSecret deve ser informada.", 1);               

            $dados = $this->getDadosCep_WebManiaBr($cep, $appKey, $appSecret);
            if (isset($dados['cep']))
               $dadosCep->setCep($dados['cep']);
            if (isset($dados['uf']))
               $dadosCep->setUf($dados['uf']);
            if (isset($dados['cidade']))
               $dadosCep->setCidade($dados['cidade']);
            if (isset($dados['bairro']))
               $dadosCep->setBairro($dados['bairro']);
            if (isset($dados['endereco']))
               $dadosCep->setLogradouro($dados['endereco']);
            if (isset($dados['ibge']))
               $dadosCep->setIbge((int) $dados['ibge']);
            break;
   
         default:
            throw new Exception("API desconhecida.", 1);            
            break;
      }      

      return $dadosCep;        
   }
}