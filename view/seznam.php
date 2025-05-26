<?php
$dnevi = ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"];
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Termini</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">

    <header class="mb-3">
        <p class="text-muted">Nisi prijavljen</p>

        <form action="<?= BASE_URL . "login" ?>" method="get" class="mt-4">
            <button type="submit" class="btn btn-primary">Prijava</button>
        </form>
    </header>

    <h2 class="mb-4">Razpoložljivi termini</h2>

    <?php foreach ($termini as $termin): ?>
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">
                    <strong><?= htmlspecialchars($termin["naslov"]) ?></strong><br>
                    <?= htmlspecialchars($dnevi[$termin["dan"]]) ?>,
                    <?= date("H:i", strtotime($termin["zacetek"])) ?> – <?= date("H:i", strtotime($termin["konec"])) ?><br>
                    <?= htmlspecialchars($termin["lokacija"]) ?>,<br>
                    prostih mest: <strong><?= TerminDB::prostaMesta($termin["id"]) ?></strong> /
                    <?= htmlspecialchars($termin["kapaciteta"]) ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>



</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
