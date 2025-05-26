<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Uredi termin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">

    <h2 class="mb-4">Uredi termin</h2>

    <form method="post" action="<?= BASE_URL ?>uredi" class="row g-3">
        <div class="col-md-6">
            <label for="naslov" class="form-label">Naslov</label>
            <input type="text" class="form-control" id="naslov" name="naslov" value="<?= htmlspecialchars($naslov) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="dan" class="form-label">Dan v tednu</label>
            <select class="form-select" id="dan" name="dan" required>
                <option value="1" <?= $dan == 1 ? 'selected' : '' ?>>Ponedeljek</option>
                <option value="2" <?= $dan == 2 ? 'selected' : '' ?>>Torek</option>
                <option value="3" <?= $dan == 3 ? 'selected' : '' ?>>Sreda</option>
                <option value="4" <?= $dan == 4 ? 'selected' : '' ?>>Četrtek</option>
                <option value="5" <?= $dan == 5 ? 'selected' : '' ?>>Petek</option>
                <option value="6" <?= $dan == 6 ? 'selected' : '' ?>>Sobota</option>
                <option value="0" <?= $dan == 0 ? 'selected' : '' ?>>Nedelja</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="zacetek" class="form-label">Od (ura)</label>
            <input type="time" class="form-control" id="zacetek" name="zacetek" value="<?= htmlspecialchars($zacetek) ?>" required>
        </div>

        <div class="col-md-3">
            <label for="konec" class="form-label">Do (ura)</label>
            <input type="time" class="form-control" id="konec" name="konec" value="<?= htmlspecialchars($konec) ?>" required>
        </div>

        <div class="col-md-6">
            <label for="lokacija" class="form-label">Lokacija</label>
            <input type="text" class="form-control" id="lokacija" name="lokacija" value="<?= htmlspecialchars($lokacija) ?>" required>
        </div>

        <div class="col-md-3">
            <label for="kapaciteta" class="form-label">Kapaciteta</label>
            <input type="number" class="form-control" id="kapaciteta" name="kapaciteta" min="1" value="<?= htmlspecialchars($kapaciteta) ?>" required>
        </div>

        <input type="hidden" name="terminID" value="<?= htmlspecialchars($id) ?>">

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Shrani</button>
        </div>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
