<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Prijava</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">
        <h2 class="mb-4 text-center">Prijava</h2>

        <form action="<?= BASE_URL . "login" ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Uporabniško ime</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Geslo</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($errorMessage) ?>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn w-100 btn-warning border-dark">Prijava</button>
        </form>
        

        <hr class="my-3">

        <a href="<?= BASE_URL ?>registracija" class="btn w-100 btn-warning border-dark">Registriraj se</a>

                <hr class="my-3">

        <a href="<?= BASE_URL ?>seznam" class="btn btn-outline-secondary w-100">Nadaljuj kot gost</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
