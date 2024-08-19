<?php

namespace builder;

use DateTime;
use model\Funcionario;

require_once '../model/Funcionario.php';

class FuncionarioBuilder
{
    const CPF_TAM = 11;

    private Funcionario $funcionario;

    public function __construct()
    {
        $this->funcionario = new Funcionario();
    }

    /**
     * @throws \Exception
     */
    public function modelBuild(array $campos): Funcionario
    {
        if (!$this->validaCampos($campos)) {
            throw new \Exception("Houve um problema com os dados informados, por favor refaça o processo.");
        }

        if (isset($campos['cpf'])) {
            $this->funcionario->setCpf($campos['cpf']);
        }

        $this->funcionario->setNome($campos['nome']);
        $this->funcionario->setDataNascimento(new \DateTime($campos['data_nascimento']));
        $this->funcionario->setDataPrimeiraDose(new \DateTime($campos['data_primeira_dose']));
        $this->funcionario->setDataSegundaDose(new \DateTime($campos['data_segunda_dose']));
        $this->funcionario->setDataTerceiraDose(new DateTime($campos['data_terceira_dose']));
        $this->funcionario->setVacinaAplicada($campos['vacina_aplicada']);
        $this->funcionario->setHasComorbidade(isset($campos['has_comorbidade']));

        return $this->funcionario;
    }

    private function validaCampos(array &$campos): bool
    {
        if (isset($campos['has_comorbidade'])) {
            $campos['has_comorbidade'] = 1;
        }

        if (
            !empty(array_filter($campos, function ($value) {
                return empty($value) && $value !== '0';
            }))
        ) {
            return false;
        }

        return $this->validaCpf($campos['cpf']) && $this->validaDatasVacina($campos);
    }

    private function validaCpf(&$cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        return self::CPF_TAM === strlen($cpf);
    }

    private function validaDatasVacina($campos): bool
    {
        $dataPrimeiraDose = $campos['data_primeira_dose'];
        $dataSegundaDose = $campos['data_segunda_dose'];
        $dataTerceiraDose = $campos['data_terceira_dose'];

        return $dataPrimeiraDose < $dataSegundaDose && $dataSegundaDose < $dataTerceiraDose;
    }
}
