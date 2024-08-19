<?php

namespace repository;

require_once 'IRepository.php';
class VacinaRepository implements IRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = \service\Database::connect();
    }
    public function findAll()
    {
        return $this->connection->query(
            'SELECT * FROM public."Vacinas" ORDER BY nome'
        )->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function create($vacina): void
    {
        $nome = $vacina->getNome();
        $lote = $vacina->getLote();
        $dataValidade = $vacina->getDataValidade()->format('Y-m-d');

        $query = <<<QUERY
            INSERT INTO public."Vacinas" (nome, lote, data_validade) VALUES ('$nome', '$lote', '$dataValidade')
QUERY;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
    }

    public function update($vacina): bool
    {
        $nome = $vacina->getNome();
        $lote = $vacina->getLote();
        $dataValidade = $vacina->getDataValidade()->format('Y-m-d');

        $query = <<<QUERY
            UPDATE public."Vacinas" AS v
            SET nome=?, lote=?, data_validade=?
            WHERE v.id =?
QUERY;
        $qb = $this->connection->prepare($query);

        return $qb->execute([
            $nome,
            $lote,
            $dataValidade,
            $vacina->getId()
        ]);
    }

    public function findById($id): array
    {
        $query = <<<QUERY
            SELECT * FROM public."Vacinas" AS v
            WHERE v.id = $id
QUERY;

        return $this->connection->query($query)->fetch(\PDO::FETCH_ASSOC);
    }

    public function findFuncionariosByVacina($id): array
    {
        $query = <<<QUERY
            SELECT f.*, v.id as id_vacina, v.nome as nome_vacina, v.lote as lote_vacina, v.data_validade as validade_vacina 
            FROM public."Funcionarios" AS f
            JOIN public."Vacinas" AS v on f.vacina_aplicada = v.id
            WHERE f.vacina_aplicada = $id
QUERY;

        return $this->connection->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id): bool
    {
        $query = <<<QUERY
            DELETE FROM public."Vacinas" AS v WHERE v.id = ?
QUERY;
        $qb = $this->connection->prepare($query);

        return $qb->execute([$id]);
    }
}
