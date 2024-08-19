<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body data-bs-theme="dark">
    <?php require_once '../../resource/components/nav.html' ?>
    <div class="container">
        <div class="card" data-bs-theme="dark" style="margin-top: 20px; margin-bottom: 15px;">
            <div class="card-body">
                <form action="../../controller/VacinaController.php" method="post">
                    <input hidden="hidden" name="action" value="editar">
                    <?php
                        use service\VacinaService;
                        use repository\VacinaRepository;

                        require_once '../../service/VacinaService.php';
                        require_once '../../repository/VacinaRepository.php';

                        $vacinaService = new VacinaService(null, new VacinaRepository());
                        $id = $_REQUEST['id'];

                        $vacina = $vacinaService->showVacina($id);

                        $cpf = $vacina['id'];
                        $nome = $vacina['nome'];
                        $lote = $vacina['lote'];
                        $dataValidade = $vacina['data_validade'];
                    ?>
                    <input type="hidden" name="id" value="<?php echo $id ?>" >
                    <div class="form-group">
                        <label>Nome:</label>
                        <input class="form-control" type="text" name="nome" value="<?php echo $nome ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Lote:</label>
                        <input class="form-control" type="text" name="lote" value="<?php echo $lote ?>">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data de Validade:</label>
                        <input class="form-control" type="date" name="data_validade" value="<?php echo $dataValidade ?>">
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
