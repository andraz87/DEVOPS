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
        <p>Imaš <?php echo UporabnikDB::steviloPrisotnosti($_SESSION["user"]["id"]); ?> prisotnosti</p>

    </header>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL . "logout" ?>">Odjava</a></li>
        </ul>
    </nav>

<h2>Razpoložljivi termini</h2>

<?php if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "student"): ?>
<form action="<?= BASE_URL?>" method="post">
    <?php foreach ($termini as $termin): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <label>
                <input type="radio" name="termin_id" value="<?= $termin["id"] ?>" required>
                
                <?= htmlspecialchars($termin["naslov"]) ?>
                <?php if ($termin["id"] == $_SESSION["user"]["termin_id"]) echo "__________________________(tvoj termin)"; ?>
                <br>
                <?= htmlspecialchars($dnevi[$termin["dan"]]) ?>,
                <?= date("H:i", strtotime($termin["zacetek"])) ?> – <?= date("H:i", strtotime($termin["konec"])) ?>
                <br>
                <?= htmlspecialchars($termin["lokacija"]) ?>, prostih mest: <?=TerminDB::prostaMesta($termin["id"]) ?> /
                <?= htmlspecialchars($termin["kapaciteta"]) ?>
            </label>
        </div>
    <?php endforeach; ?>
    <button type="submit">Pošlji rezervacijo</button>
    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
    <?php endif; ?>
</form>
<?php else: ?>
<p>Za rezervacijo termina se morate prijaviti kot študent.</p>
<?php endif; ?>

    
</body>
</html>