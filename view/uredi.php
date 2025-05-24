<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>

<h2>Dodaj nov termin</h2>

<form method="post" action="<?= BASE_URL ?>uredi">
    <label>Naslov: <input type="text" name="naslov" value="<?=htmlspecialchars($naslov) ?>" required /></label><br />
    <label>Dan v tednu:
        <select name="dan" required>
        <option value="1" <?= $dan == 1 ? 'selected' : '' ?>>Ponedeljek</option>
        <option value="2" <?= $dan == 2 ? 'selected' : '' ?>>Torek</option>
        <option value="3" <?= $dan == 3 ? 'selected' : '' ?>>Sreda</option>
        <option value="4" <?= $dan == 4 ? 'selected' : '' ?>>Četrtek</option>
        <option value="5" <?= $dan == 5 ? 'selected' : '' ?>>Petek</option>
        <option value="6" <?= $dan == 6 ? 'selected' : '' ?>>Sobota</option>
        <option value="0" <?= $dan == 0 ? 'selected' : '' ?>>Nedelja</option>
</select>

</label><br />
    <label>Od (ura): <input type="time" name="zacetek" value="<?=htmlspecialchars($zacetek) ?>" required /></label><br />
    <label>Do (ura): <input type="time" name="konec" value="<?=htmlspecialchars($konec) ?>" required /></label><br />
    <label>Lokacija: <input type="text" name="lokacija" value="<?=htmlspecialchars($lokacija) ?>" required /></label><br />
    <label>Kapaciteta: <input type="number" name="kapaciteta" min="1" value="<?=htmlspecialchars($kapaciteta) ?>" required /></label><br />
    
    <input type="hidden" name="terminID" value="<?=htmlspecialchars($id) ?>">
    <input type="submit" value="Shrani" />
</form>

<br>

    
</body>
</html>