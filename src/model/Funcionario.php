<?php

namespace model;

class Funcionario
{
    private $cpf;
    private $nome;
    private $dataNascimento;
    private $dataPrimeiraDose;
    private $dataSegundaDose;
    private $dataTerceiraDose;
    private $vacinaAplicada;
    private $hasComorbidade;

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataPrimeiraDose()
    {
        return $this->dataPrimeiraDose;
    }

    public function setDataPrimeiraDose($dataPrimeiraDose)
    {
        $this->dataPrimeiraDose = $dataPrimeiraDose;
    }

    public function getDataSegundaDose()
    {
        return $this->dataSegundaDose;
    }

    public function setDataSegundaDose($dataSegundaDose)
    {
        $this->dataSegundaDose = $dataSegundaDose;
    }

    public function getDataTerceiraDose()
    {
        return $this->dataTerceiraDose;
    }

    public function setDataTerceiraDose($dataTerceiraDose)
    {
        $this->dataTerceiraDose = $dataTerceiraDose;
    }

    public function getVacinaAplicada()
    {
        return $this->vacinaAplicada;
    }

    public function setVacinaAplicada($vacinaAplicada)
    {
        $this->vacinaAplicada = $vacinaAplicada;
    }

    public function getHasComorbidade()
    {
        return $this->hasComorbidade;
    }

    public function setHasComorbidade($hasComorbidade)
    {
        $this->hasComorbidade = $hasComorbidade;
    }
}
