<?php
$dnevi = ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"];
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Prisotnost za termin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-4">
    <h2>Prisotnost za termin:</h2>
    <div class="mb-3 p-3 border rounded bg-light">
        <p class="mb-0">
            <strong><?= htmlspecialchars($termin["naslov"]) ?></strong><br />
            <?= htmlspecialchars($dnevi[$termin["dan"]]) ?>,
            <?= date("H:i", strtotime($termin["zacetek"])) ?> – <?= date("H:i", strtotime($termin["konec"])) ?><br />
            <?= htmlspecialchars($termin["lokacija"]) ?>,<br />
            prostih mest: <span class="fw-bold"><?= TerminDB::prostaMesta($termin["id"]) ?></span> /
            <?= htmlspecialchars($termin["kapaciteta"]) ?>
        </p>
    </div>

    <h3>Označi prisotne:</h3>
    <form method="post" action="<?= BASE_URL ?>prisotni">
        <h4>Študenti na terminu</h4>
        <ul class="list-unstyled mb-4">
            <?php foreach ($studentiNaTerminu as $student): ?>
                <li class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenti[]" value="<?= $student["id"] ?>" id="student<?= $student["id"] ?>" />
                    <label class="form-check-label" for="student<?= $student["id"] ?>">
                        <?= htmlspecialchars($student["ime"]) ?> <?= htmlspecialchars($student["priimek"]) ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>

        <h4>Študenti, ki niso na terminu</h4>
        <ul class="list-unstyled mb-4">
            <?php foreach ($studentiKiNisoNaTerminu as $student): ?>
                <li class="form-check">
                    <input class="form-check-input" type="checkbox" name="studenti[]" value="<?= $student["id"] ?>" id="student<?= $student["id"] ?>" />
                    <label class="form-check-label" for="student<?= $student["id"] ?>">
                        <?= htmlspecialchars($student["ime"]) ?> <?= htmlspecialchars($student["priimek"]) ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>

        <input type="hidden" name="terminID" value="<?= $termin["id"] ?>" />
        <button type="submit" class="btn btn-primary">Potrdi prisotnost</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
