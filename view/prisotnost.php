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

<h2>Prisotnost za termin:</h2>
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


        <h3>Označi prisotne:</h3>


<form method="post" action="<?= BASE_URL ?>prisotni">
    <ul>
        <?php foreach ($studenti as $student): ?>
            <li>
                <label>
                    <input type="checkbox" name="studenti[]" value="<?= $student["id"] ?>" />
                    <?= htmlspecialchars($student["ime"]) ?> <?= htmlspecialchars($student["priimek"]) ?> 
                </label>
            </li>
        <?php endforeach; ?>
        <input type="hidden" name="terminID" value="<?= $termin["id"] ?>" />
    </ul>
    <button type="submit">Potrdi prisotnost</button>
</form>

    
</body>
</html>