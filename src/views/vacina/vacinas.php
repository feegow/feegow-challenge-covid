<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="../../resource/css/style.css" rel="stylesheet">
</head>
<body data-bs-theme="dark">
    <?php require_once '../../resource/components/nav.html' ?>
    <main role="main" class="container">
        <div class="table-responsive" >
            <?php if (isset($_REQUEST['status'])) { ?>
                <?php if ($_REQUEST['status'] !== 'error') { ?>
                    <?php
                    $message = $_REQUEST['status'] === 'created' ? 'cadastrada' : (($_REQUEST['status'] === 'edited')
                        ? 'editada' : 'excluída')
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" style="margin-top: 10px;" role="alert">
                        Vacina <?php echo $message ?> com sucesso!
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

            <h5 class="card-title" style="margin-top: 50px">Vacinas</h5>

            <div style="margin-top: 20px; margin-bottom: 15px;">
                <a class="btn btn-outline-primary btn-xs raised" href="../vacina/nova-vacina.php" >Novo</a>
            </div>
            <table class="table table-dark table-striped-columns table-borderless table-hover">
                <thead>
                <tr>
                    <th>
                        Nome
                    </th>
                    <th>
                        Lote
                    </th>
                    <th>
                        Data de validade
                    </th>
                    <th class="col-md-3">
                        Ações
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                    use service\VacinaService;
                    use repository\VacinaRepository;

                    require_once '../../model/Vacina.php';
                    require_once '../../service/VacinaService.php';
                    require_once '../../repository/VacinaRepository.php';

                    $today = new \DateTime();
                    $vacinaService = new VacinaService(null, new VacinaRepository());
                    $vacinas = $vacinaService->getVacinas();
                ?>
                <?php foreach($vacinas as $vacina) { ?>
                    <tr class="<?php echo $today > (new \DateTime($vacina['data_validade'])) ? 'table-danger' : ''?>">
                        <th> <?php echo $vacina['nome']; ?> </th>
                        <th> <?php echo $vacina['lote']; ?> </th>
                        <th> <?php echo (new \DateTime($vacina['data_validade']))->format('d/m/Y'); ?> </th>
                        <th>
                            <a class="btn btn-outline-primary btn-xs raised" href="edit.php?id=<?php echo $vacina['id'] ?>" >Editar</a>
                            <a class="btn btn-outline-light btn-xs raised" href="../../controller/VacinaController.php?action=funcionarios&id=<?php echo $vacina['id'] ?>" >Funcionários vacinados</a>
                        </th>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php require_once '../../resource/components/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
