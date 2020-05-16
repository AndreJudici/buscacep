<?php

declare(strict_types=1);

namespace AndreJudici\BuscaDadosCep;

class DadosCep 
{
    private $cep;
    private $cidade;
    private $uf;
    private $bairro;
    private $logradouro;
    private $complemento;
    private $unidade;
    private $ibge;
    private $gia;

    public function setCep(string $cep)
    {
        $this->cep = $cep;
    }

    public function setCidade(string $cidade)
    {
        $this->cidade = $cidade;
    }

    public function setUf(string $uf)
    {
        $this->uf = $uf;
    }

    public function setbairro(string $bairro)
    {
        $this->bairro = $bairro;
    }

    public function setlogradouro(string $logradouro)
    {
        $this->logradouro = $logradouro;
    }

    public function setComplemento(string $complemento)
    {
        $this->complemento = $complemento;
    }

    public function setUnidade(string $unidade)
    {
        $this->unidade = $unidade;
    }

    public function setIbge(int $Ibge)
    {
        $this->ibge = $Ibge;
    }

    public function setGia(int $Gia)
    {
        $this->gia = $Gia;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function getbairro(): string
    {
        return $this->bairro;
    }

    public function getlogradouro(): string
    {
        return $this->logradouro;
    }

    public function getComplemento(): string
    {
        return $this->complemento;
    }

    public function getUnidade(): string
    {
        return $this->unidade;
    }

    public function getIbge(): int
    {
        return $this->Ibge;
    }

    public function getGia(): int
    {
        return $this->Gia;
    }
    
}