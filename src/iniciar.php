<?php

use service\Database;

require_once './service/Database.php';

$db = new Database();

$db::createDatabase();
$db::createVacinaTable();
$db::createFuncionarioTable();
