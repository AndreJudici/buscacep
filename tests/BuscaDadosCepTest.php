<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use AndreJudici\BuscaDadosCep\BuscaDadosCep;

class BuscaDadosCepTest extends TestCase
{
    /**
     * @dataProvider dadosTeste     
     */
    public function testGetDadosCep(string $cep, string $api = BuscaDadosCep::API_VIACEP, string $appKey = '', string $appSecret = '')
    {
        $busca = new BuscaDadosCep();
        $dados = $busca->getDadosCep($cep, $api, $appKey, $appSecret);

        $this->assertEquals($dados->getCep(), $cep);
    }

    public function dadosTeste()
    {
        return [
            'ViaCep -> Praca da Sé' => [
                '01001-000'
             ],
            'CepLa -> Praca da Sé' => [
                '01001-000',
                BuscaDadosCep::API_CEPLA
            ],
            'ApiCep -> Praca da Sé' => [
                '01001-000',
                BuscaDadosCep::API_APICEP
            ],
            'WebManiaBr -> Praca da Sé' => [
                '01001-000',
                BuscaDadosCep::API_WEBMANIABR,
                '3YbQ8BTNxA145ejKfVei8LIugn3A8iJa',
                'XbZlf91aF7wc8BLVCpsvxfSC0nGaFaw3AQstD8ZqtTh6iuN0'
            ]
        ];
    }
}


