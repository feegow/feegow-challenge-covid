<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
    <div class="container table-responsive">
        <h5 class="card-title" style="margin-top: 50px">Funcionários</h5>

        <div style="margin-top: 20px; margin-bottom: 15px;"></a>
            <a class="btn btn-outline-primary btn-xs raised" href="../funcionario/novo-funcionario.php" >Novo</a>
            <a class="btn btn-outline-primary raised" onClick="JavaScript: window.history.back();">Voltar</a>
        </div>

        <table class="table table-dark table-striped-columns table-hover">
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
                <th >
                    Vacina aplicada
                </th>
                <th class="hide">
                    Possui comorbidade
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            use service\FuncionarioService;
            use service\VacinaService;
            use enum\VacinaEnum;
            use repository\VacinaRepository;
            use repository\FuncionarioRepository;

            require_once '../../service/FuncionarioService.php';
            require_once '../../service/VacinaService.php';
            require_once '../../enum/VacinaEnum.php';
            require_once '../../repository/VacinaRepository.php';
            require_once '../../repository/FuncionarioRepository.php';

            $funcionarioService = new FuncionarioService(null, new FuncionarioRepository());
            $vacinaService = new VacinaService(null, new VacinaRepository());
            $vacinaEnum = new VacinaEnum();
            $funcionarios = $vacinaService->getFuncionariosVacinadosByVacina($_REQUEST['id']);
            ?>

            <?php foreach($funcionarios as $funcionario) { ?>
                <tr>
                    <th> <?php echo $funcionario['cpf']; ?> </th>
                    <th> <?php echo $funcionario['nome']; ?> </th>
                    <th class="hide"> <?php echo (new \DateTime($funcionario['data_nascimento']))->format('d/m/Y'); ?> </th>
                    <th class="hide"> <?php echo (new \DateTime($funcionario['data_primeira_dose']))->format('d/m/Y'); ?> </th>
                    <th class="hide"> <?php echo (new \DateTime($funcionario['data_segunda_dose']))->format('d/m/Y'); ?> </th>
                    <th class="hide"> <?php echo (new \DateTime($funcionario['data_terceira_dose']))->format('d/m/Y'); ?> </th>
                    <th> <?php echo $funcionario['nome_vacina']. ' - '. $funcionario['lote_vacina']; ?> </th>
                    <th class="hide"> <?php echo ($funcionario['has_comorbidade'] ? 'Sim' : 'Não'); ?> </th>
                </tr>
            <?php } ?>

            </tbody>

        </table>
        <?php if(empty($funcionarios)) { ?>
            <h1>Não há funcionários vacinados com esta vacina.</h1>
        <?php } ?>
    </div>

    <?php require_once '../../resource/components/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
