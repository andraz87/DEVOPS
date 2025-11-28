<?php
$dnevi = ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"];
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Termini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-4">
        <header class="mb-4">
            <div class="alert alert-primary" role="alert">
                <p class="mb-1">Prijavljen si kot: <strong><?= htmlspecialchars($username) ?></strong></p>
                <p class="mb-0">Imaš <strong><?= UporabnikDB::steviloPrisotnosti($_SESSION["user"]["id"]); ?></strong> prisotnosti.</p>
            </div>
            <a href="<?= BASE_URL . "logout" ?>" class="btn btn-outline-danger mb-3">Odjava</a>
        </header>

        <h2 class="mb-4">Razpoložljivi termini</h2>

        <?php if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "student"): ?>
            <form action="<?= BASE_URL ?>" method="post">
                <div class="row row-cols-1 g-3">
                    <?php foreach ($termini as $termin): ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <label class="form-check-label w-100">
                                        <input type="radio" class="form-check-input me-2" name="termin_id" value="<?= $termin["id"] ?>" required>
                                        <h5 class="card-title d-inline"><?= htmlspecialchars($termin["naslov"]) ?></h5>
                                        <?php if ($termin["id"] == $_SESSION["user"]["termin_id"]): ?>
                                            <span class="badge bg-success ms-2">Tvoj termin</span>
                                        <?php endif; ?>
                                        <p class="card-text mt-2 mb-1">
                                            <?= htmlspecialchars($dnevi[$termin["dan"]]) ?>,
                                            <?= date("H:i", strtotime($termin["zacetek"])) ?> – <?= date("H:i", strtotime($termin["konec"])) ?>
                                        </p>
                                        <p class="card-text">
                                            <?= htmlspecialchars($termin["lokacija"]) ?>,
                                            prostih mest:
                                            <?= TerminDB::prostaMesta($termin["id"]) ?> /
                                            <?= htmlspecialchars($termin["kapaciteta"]) ?>
                                        </p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Pošlji rezervacijo</button>
                </div>

                <?php if (!empty($errorMessage)): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">Za rezervacijo termina se morate prijaviti kot študent.</div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
