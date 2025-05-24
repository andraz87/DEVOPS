<?php
$dnevi = ["Nedelja", "Ponedeljek", "Torek", "Sreda", "Četrtek", "Petek", "Sobota"];
?>

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
    <header>
        <p>prijavljen si kot: <?= htmlspecialchars($username) ?></p>

    </header>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL . "logout" ?>">Odjava</a></li>
        </ul>
    </nav>

<h2>termini</h2>

<?php foreach ($termini as $termin): ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
        <p>
            <?= htmlspecialchars($termin["naslov"]) ?>
            <br>
            <?= htmlspecialchars($dnevi[$termin["dan"]]) ?>,
            <?= date("H:i", strtotime($termin["zacetek"])) ?> – <?= date("H:i", strtotime($termin["konec"])) ?>
            <br>
            <?= htmlspecialchars($termin["lokacija"]) ?>,
            prostih mest: <?= TerminDB::prostaMesta($termin["id"]) ?> /
            <?= htmlspecialchars($termin["kapaciteta"]) ?>
        </p>

        <form action="<?= BASE_URL . "uredi" ?>" method="get" style="display:inline;">
            <input type="hidden" name="terminID" value="<?= $termin["id"] ?>">
            <button type="submit">Uredi</button>
        </form>

        <form action="<?= BASE_URL . "izbrisi" ?>" method="post" style="display:inline;">
            <input type="hidden" name="termin_id" value="<?= $termin["id"] ?>">
            <button type="submit" onclick="return confirm('Si prepričan, da želiš izbrisati?')">Izbriši</button>
        </form>
        <form action="<?= BASE_URL . "prisotni" ?>" method="get">
            <input type="hidden" name="terminID" value="<?= $termin["id"] ?>">
            <button type="submit">označi prisotne</button>
        </form>
    </div>
<?php endforeach; ?>

<form action="<?= BASE_URL . "dodaj" ?>" method="get">
    <button type="submit">Dodaj termin</button>
</form>



    
</body>
</html>