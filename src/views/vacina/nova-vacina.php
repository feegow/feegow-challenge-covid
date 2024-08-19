<!doctype html>
<html lang="en">
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
                <h5 class="card-title">Nova vacina</h5>

                <form action="../../controller/VacinaController.php" method="POST">
                    <input hidden="hidden" name="action" value="novo">
                    <div class="form-group" style="margin-top: 10px;">
                        <label>Nome:</label>
                        <select class="form-select" aria-label="Default select example" name="nome">
                            <option value="">Selecione</option>
                            <?php
                                use enum\VacinaEnum;

                                require_once '../../enum/VacinaEnum.php';

                                $vacinas = VacinaEnum::vacinasNomes();
                            ?>
                            <?php foreach ($vacinas as $vacina) {?>
                                <option value="<?php echo $vacina; ?>"><?php echo $vacina ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Lote:</label>
                        <input class="form-control" type="text" placeholder="Lote" name="lote" required>
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label>Data Validade:</label>
                        <input class="form-control" type="date" placeholder="d/m/YYYY" name="data_validade" required>
                    </div>

                    <div class="btn-group" style="margin-top: 10px;">
                        <div style="margin-right: 5px;">
                            <button class="btn btn-outline-success raised" type="submit">Salvar</button>
                        </div>
                        <div>
                            <a class="btn btn-outline-primary raised" onClick="window.history.back();">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once '../../resource/components/footer.html' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
