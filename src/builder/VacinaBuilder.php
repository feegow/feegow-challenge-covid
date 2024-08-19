<?php

namespace builder;

use model\Vacina;

require_once '../model/Vacina.php';

class VacinaBuilder
{
    private Vacina $vacina;

    public function __construct()
    {
        $this->vacina = new Vacina();
    }

    public function modelBuild(array $campos)
    {
        if (!$this->validaDataValidade($campos['data_validade'])) {
            throw new \Exception("Houve um problema com os dados informados, por favor refaça o processo.");
        }

        if (isset($campos['id'])) {
            $this->vacina->setId($campos['id']);
        }

        $this->vacina->setNome($campos['nome']);
        $this->vacina->setLote($campos['lote']);
        $this->vacina->setDataValidade(new \DateTime($campos['data_validade']));

        return $this->vacina;
    }

    private function validaDataValidade(string $dataValidade): bool
    {
        $today = new \DateTime();

        return $today < new \DateTime($dataValidade);
    }
}
