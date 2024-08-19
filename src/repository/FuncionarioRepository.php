<?php

namespace repository;

require_once 'IRepository.php';

class FuncionarioRepository implements IRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = \service\Database::connect();
    }

    public function findAll(): array
    {
        $query = <<<QUERY
            SELECT f.*, v.id as id_vacina, v.nome as nome_vacina, v.lote as lote_vacina, v.data_validade as validade_vacina 
            FROM public."Funcionarios" AS f 
            JOIN public."Vacinas" AS v ON f.vacina_aplicada = v.id 
            ORDER BY f.nome
QUERY;

        return $this->connection->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($funcionario): void
    {
        $cpf = $funcionario->getCpf();
        $nome = $funcionario->getNome();
        $dataNascimento = $funcionario->getDataNascimento()->format('Y-m-d');
        $dataPrimeiraDose = $funcionario->getDataPrimeiraDose()->format('Y-m-d');
        $dataSegundaDose = $funcionario->getDataSegundaDose()->format('Y-m-d');
        $dataTerceiraDose = $funcionario->getDataTerceiraDose()->format('Y-m-d');
        $vacinaAplicada = $funcionario->getVacinaAplicada();
        $hasComorbidade = $funcionario->getHasComorbidade() ? 1 : 0;

        $query = <<<QUERY
                INSERT INTO public."Funcionarios" (
                                   cpf, 
                                   nome, 
                                   data_nascimento, 
                                   data_primeira_dose, 
                                   data_segunda_dose, 
                                   data_terceira_dose, 
                                   vacina_aplicada, 
                                   has_comorbidade
                 ) VALUES (
                           '$cpf', 
                           '$nome', 
                           '$dataNascimento', 
                           '$dataPrimeiraDose', 
                           '$dataSegundaDose', 
                           '$dataTerceiraDose', 
                           '$vacinaAplicada', 
                           '$hasComorbidade'
                )
QUERY;

        $this->connection->exec($query);
    }

    public function update($funcionario): bool
    {
        $query = <<<QUERY
            UPDATE public."Funcionarios" AS f
            SET nome=?, data_nascimento=?, data_primeira_dose=?, data_segunda_dose=?, data_terceira_dose=?, vacina_aplicada=?, has_comorbidade=?
            WHERE f.cpf =?
QUERY;
        $qb = $this->connection->prepare($query);

        return $qb->execute([
            $funcionario->getNome(),
            $funcionario->getDataNascimento()->format('Y-m-d'),
            $funcionario->getDataPrimeiraDose()->format('Y-m-d'),
            $funcionario->getDataSegundaDose()->format('Y-m-d'),
            $funcionario->getDataTerceiraDose()->format('Y-m-d'),
            $funcionario->getVacinaAplicada(),
            $funcionario->getHasComorbidade(),
            $funcionario->getCpf()
        ]);
    }

    public function delete(string $cpf): bool
    {
        $query = <<<QUERY
            DELETE FROM public."Funcionarios" AS f WHERE f.cpf = ?
QUERY;
        $qb = $this->connection->prepare($query);

        return $qb->execute([$cpf]);
    }

    public function findById(string $cpf): array
    {
        $query = <<<QUERY
            SELECT f.*, v.id as id_vacina, v.nome as nome_vacina, v.lote as lote_vacina, v.data_validade as validade_vacina 
            FROM public."Funcionarios" AS f
            JOIN public."Vacinas" AS v ON f.vacina_aplicada = v.id
            WHERE f.cpf = '$cpf'
QUERY;

        return $this->connection->query($query)->fetch(\PDO::FETCH_ASSOC);
    }
}
