<?php

namespace service;
use PDO;

class Database
{
    const HOST = '172.25.0.2';
    const USER = 'postgres';
    const PASS = 'postgres';
    const DATABASE = 'sys_covid';

    public static function connect()
    {
        try {
            $connection = new PDO("pgsql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USER, self::PASS);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
        } catch (\PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public static function createDatabase()
    {
        $connection = new PDO("pgsql:host=" . self::HOST, self::USER, self::PASS);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "CREATE DATABASE sys_covid";

        if ($connection->query($query)) {
            echo 'Database sys_covid criado com sucesso.';
        }
    }

    public static function createVacinaTable()
    {
        $connection = new PDO("pgsql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USER, self::PASS);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = <<<QUERY
            CREATE TABLE IF NOT EXISTS public."Vacinas" (
                id bigint NOT NULL GENERATED ALWAYS AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
                nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
                lote character varying(100) COLLATE pg_catalog."default" NOT NULL,
                data_validade date NOT NULL,
                CONSTRAINT "Vacinas_pkey" PRIMARY KEY (id)
            )
QUERY;
        if ($connection->exec($query)) {
            echo 'Tabela Vacinas criada com sucesso.';
        }
    }

    public static function createFuncionarioTable()
    {
        $connection = new PDO("pgsql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USER, self::PASS);

        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = <<<QUERY
            CREATE TABLE IF NOT EXISTS public."Funcionarios" (
                cpf character varying(11) COLLATE pg_catalog."default" NOT NULL,
                nome character varying(100) COLLATE pg_catalog."default" NOT NULL,
                data_nascimento date NOT NULL,
                data_primeira_dose date NOT NULL,
                data_segunda_dose date NOT NULL,
                data_terceira_dose date NOT NULL,
                vacina_aplicada bigint NOT NULL,
                has_comorbidade boolean NOT NULL,
                CONSTRAINT "Funcionarios_pkey" PRIMARY KEY (cpf),
                CONSTRAINT "Funcionarios_vacina_aplicada_fkey" FOREIGN KEY (vacina_aplicada)
                REFERENCES public."Vacinas" (id) MATCH SIMPLE
                ON UPDATE NO ACTION
                ON DELETE NO ACTION
            )
QUERY;
        if ($connection->exec($query)) {
            echo 'Tabela Funcionarios criada com sucesso.';
        }
    }
}
