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
        <p>Nisi prijavljen</p>

    </header>

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
    </div>
<?php endforeach; ?>

<form action="<?= BASE_URL . "login" ?>" method="get">
    <button type="submit">Prijava</button>
</form>



    
</body>
</html>