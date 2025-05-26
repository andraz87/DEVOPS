<?php
$dnevi = ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"];
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Termini</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-4">

    <header class="mb-3">
        <p class="text-end">Prijavljen si kot: <strong><?= htmlspecialchars($username) ?></strong></p>
    </header>

    <nav class="mb-4">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= BASE_URL . "logout" ?>">Odjava</a>
            </li>
        </ul>
    </nav>

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

                <div class="d-flex flex-wrap gap-2">
                    <form action="<?= BASE_URL . "uredi" ?>" method="get">
                        <input type="hidden" name="terminID" value="<?= $termin["id"] ?>">
                        <button type="submit" class="btn btn-warning btn-sm">Uredi</button>
                    </form>

                    <form action="<?= BASE_URL . "izbrisi" ?>" method="post" onsubmit="return confirm('Si prepričan, da želiš izbrisati?')">
                        <input type="hidden" name="termin_id" value="<?= $termin["id"] ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Izbriši</button>
                    </form>

                    <form action="<?= BASE_URL . "prisotni" ?>" method="get">
                        <input type="hidden" name="terminID" value="<?= $termin["id"] ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Označi prisotne</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <form action="<?= BASE_URL . "dodaj" ?>" method="get">
        <button type="submit" class="btn btn-success">Dodaj termin</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
