<?php

namespace repository;

interface IRepository
{
    public function findAll();

    public function create($objeto);

    public function update($objeto);

    public function delete(string $id);

    public function findById(string $id);
}
