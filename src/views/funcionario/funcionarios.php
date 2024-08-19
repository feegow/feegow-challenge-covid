<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="../../resource/css/style.css" rel="stylesheet">
    <style>
        @media (max-width: 575.98px) {
            .hide {
                display: none;
            }
        }
    </style>
</head>
<body data-bs-theme="dark">
    <?php require_once '../../resource/components/nav.html' ?>
    <main role="main" class="container">
        <div class="table-responsive">
            <?php if (isset($_REQUEST['status'])) { ?>
                <?php if ($_REQUEST['status'] !== 'error') { ?>
                    <?php
                    $message = $_REQUEST['status'] === 'created' ? 'cadastrado' : (($_REQUEST['status'] === 'edited')
                        ? 'editado' : 'excluído')
                    ?>
                    <div class="alert alert-<?php echo $_REQUEST['status'] === 'deleted' ? 'danger' : 'success' ?> alert-dismissible fade show" style="margin-top: 10px;" role="alert">
                        Funcionário <?php echo $message ?> com sucesso!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php if ($_REQUEST['status'] === 'error') { ?>
                    <div class="alert alert-danger alert-dismissible fade show" style="margin-top: 10px;" role="alert">
                        Ocorreu um erro ao finalizar o processo!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            <?php } ?>

            <div class="row">
                <div class="col-">
                    <h5 class="card-title" style="margin-top: 50px">Funcionários</h5>

                    <div style="margin-top: 20px; margin-bottom: 15px;">
                        <a class="btn btn-outline-primary btn-xs raised" href="../funcionario/novo-funcionario.php" >Novo</a>
                    </div>
                    <table class="table table-dark table-striped-columns table-borderless table-hover">
                        <thead>
                        <tr>
                            <th>
                                CPF
                            </th>
                            <th>
                                Nome
                            </th>
                            <th class="hide">
                                Data de nascimento
                            </th>
                            <th class="hide">
                                Data da primeira dose
                            </th>
                            <th class="hide">
                                Data da segunda dose
                            </th>
                            <th class="hide">
                                Data da terceira dose
                            </th>
                            <th>
                                Vacina aplicada
                            </th>
                            <th class="hide">
                                Possui comorbidade
                            </th>
                            <th class="col-md-2">
                                Ações
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        use service\FuncionarioService;
                        use repository\FuncionarioRepository;
                        use enum\VacinaEnum;

                        require_once '../../service/FuncionarioService.php';
                        require_once '../../repository/FuncionarioRepository.php';
                        require_once '../../enum/VacinaEnum.php';

                        $funcionarioService = new FuncionarioService(null, new FuncionarioRepository());
                        $vacinaEnum = new VacinaEnum();
                        $funcionarios = $funcionarioService->getFuncionarios();
                        ?>
                        <?php foreach($funcionarios as $funcionario) { ?>
                            <tr>
                                <th> <?php echo $funcionario['cpf']; ?> </th>
                                <th> <?php echo $funcionario['nome']; ?> </th>
                                <th class="hide"> <?php echo (new \DateTime($funcionario['data_nascimento']))->format('d/m/Y'); ?> </th>
                                <th class="hide"> <?php echo (new \DateTime($funcionario['data_primeira_dose']))->format('d/m/Y'); ?> </th>
                                <th class="hide"> <?php echo (new \DateTime($funcionario['data_segunda_dose']))->format('d/m/Y'); ?> </th>
                                <th class="hide"> <?php echo (new \DateTime($funcionario['data_terceira_dose']))->format('d/m/Y'); ?> </th>
                                <th> <?php echo $funcionario['nome_vacina']; ?> </th>
                                <th class="hide"> <?php echo ($funcionario['has_comorbidade'] ? 'Sim' : 'Não'); ?> </th>
                                <th>
                                    <a class="btn btn-outline-primary btn-xs raised" href="edit.php?cpf=<?php echo $funcionario['cpf'] ?>" >Editar</a>
                                    <a class="btn btn-outline-danger btn-xs raised" href='../../controller/GerenciamentoController.php?action=deletar&cpf=<?php echo $funcionario['cpf'] ?>' >Deletar</a>
                                </th>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php require_once '../../resource/components/footer.html' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
