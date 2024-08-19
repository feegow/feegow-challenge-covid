<?php

namespace model;

class Vacina
{
    private $id;
    private $nome;
    private $lote;
    private $dataValidade;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getLote()
    {
        return $this->lote;
    }

    public function setLote(string $lote)
    {
        $this->lote = $lote;
    }

    public function getDataValidade()
    {
        return $this->dataValidade;
    }

    public function setDataValidade(\DateTime $dataValidade)
    {
        $this->dataValidade = $dataValidade;
    }
}
