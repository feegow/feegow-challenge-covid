<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="../../resource/css/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php require_once '../../resource/components/nav.html' ?>
    <div class="container">
        <div class="card" data-bs-theme="dark" style="margin-top: 20px; margin-bottom: 15px;">
            <div class="card-body">
                <form action="../../controller/GerenciamentoController.php" method="post">
                    <input hidden="hidden" name="action" value="editar">
                    <?php
                        use service\FuncionarioService;
                        use repository\FuncionarioRepository;

                        require_once '../../service/FuncionarioService.php';
                        require_once '../../repository/FuncionarioRepository.php';

                        $funcionarioService = new FuncionarioService(null, new FuncionarioRepository());
                        $cpf = $_REQUEST['cpf'];
                        $funcionario = $funcionarioService->showFuncionario($cpf);

                        $cpf = $funcionario['cpf'];
                        $nome = $funcionario['nome'];
                        $dataNascimento = $funcionario['data_nascimento'];
                        $dataPrimeiraDose = $funcionario['data_primeira_dose'];
                        $dataSegundaDose = $funcionario['data_segunda_dose'];
                        $dataTerceiraDose = $funcionario['data_terceira_dose'];
                        $vacinaAplicada = $funcionario['vacina_aplicada'];
                        $hasComorbidade = $funcionario['has_comorbidade'];
                    ?>
                    <input type="hidden" name="cpf" value="<?php echo $cpf ?>" >
                    <div class="form-group">
                        <label>CPF:</label>
                        <input class="form-control" type="text" name="cpf" value="<?php echo $cpf ?>" disabled>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label>Nome:</label>
                        <input class="form-control" type="text" name="nome" value="<?php echo $nome ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data de Nascimento:</label>
                        <input class="form-control" type="date" name="data_nascimento" value="<?php echo $dataNascimento ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data da Primeira Dose:</label>
                        <input class="form-control" type="date" name="data_primeira_dose" value="<?php echo $dataPrimeiraDose ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data da Segunda Dose:</label>
                        <input class="form-control" type="date" name="data_segunda_dose" value="<?php echo $dataSegundaDose ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data da Terceira Dose:</label>
                        <input class="form-control" type="date" name="data_terceira_dose" value="<?php echo $dataTerceiraDose ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Vacina Aplicada:</label>
                        <select class="form-select" aria-label="Default select example" name="vacina_aplicada">
                            <option value="">Selecione</option>
                            <?php
                                use service\VacinaService;
                                use repository\VacinaRepository;

                                require_once '../../service/VacinaService.php';
                                require_once '../../repository/VacinaRepository.php';

                                $vacinaService = new VacinaService(null, new VacinaRepository());
                                $vacinas = $vacinaService->getVacinas();
                            ?>
                            <option value="<?php echo $funcionario['id_vacina'] ?>" selected><?php echo $funcionario['nome_vacina']. ' - Lote: ' .$funcionario['lote_vacina']?></option>
                            <?php foreach ($vacinas as $vacina) {?>
                                <?php if ($vacina['id'] !== $funcionario['id_vacina']) {?>
                                    <option value="<?php echo $vacina['id']; ?>"><?php echo $vacina['nome']. ' - Lote: ' .$vacina['lote']?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="has_comorbidade" <?php echo $hasComorbidade ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexCheckDefault">
                            Possui alguma comorbidade?
                        </label>
                    </div>

                    <div class="btn-group" style="margin-top: 10px;">
                        <div style="margin-right: 5px;">
                            <button class="btn btn-outline-success raised" type="submit">Salvar</button>
                        </div>
                        <div>
                            <a class="btn btn-outline-danger raised" onClick="JavaScript: window.history.back();">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once '../../resource/components/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
