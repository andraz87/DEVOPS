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

<form method="post" action="<?= BASE_URL ?>dodaj">
    <label>Naslov: <input type="text" name="naslov" required /></label><br />
    <label>Dan v tednu:
    <select name="dan" required>
        <option value="1">Ponedeljek</option>
        <option value="2">Torek</option>
        <option value="3">Sreda</option>
        <option value="4">Četrtek</option>
        <option value="5">Petek</option>
        <option value="6">Sobota</option>
        <option value="0">Nedelja</option>
    </select>
</label><br />
    <label>Od (ura): <input type="time" name="zacetek" required /></label><br />
    <label>Do (ura): <input type="time" name="konec" required /></label><br />
    <label>Lokacija: <input type="text" name="lokacija" required /></label><br />
    <label>Kapaciteta: <input type="number" name="kapaciteta" min="1" required /></label><br />
    <button type="submit">Dodaj termin</button>
</form>

    
</body>
</html>