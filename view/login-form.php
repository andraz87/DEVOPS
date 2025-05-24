<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Prijava</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    

    <form action="<?= BASE_URL . "login" ?>" method="post">
        <label>Uporabniško ime:
            <input type="text" name="username" required autofocus>
        </label><br>
    
        <label>Geslo:
            <input type="password" name="password" required>
        </label><br>
    
        <button type="submit">Prijava</button>
    
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
        <?php endif; ?>
    </form>

    <button onclick="window.location.href='<?= BASE_URL ?>seznam'">Nadaljuj brez registracije</button>
    
    
</body>
</html>