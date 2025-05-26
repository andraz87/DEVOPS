<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8" />
    <title>Registracija</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-4">
    <h2>Registracija novega uporabnika</h2>

    <form action="<?= BASE_URL . "registracija" ?>" method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="username" class="form-label">Uporabniško ime:</label>
            <input type="text" id="username" name="username" class="form-control" required autofocus>
            <div class="invalid-feedback">Prosim, vnesite uporabniško ime.</div>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Geslo:</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <div class="invalid-feedback">Prosim, vnesite geslo.</div>
        </div>

        <div class="mb-3">
            <label for="ime" class="form-label">Ime:</label>
            <input type="text" id="ime" name="ime" class="form-control" required>
            <div class="invalid-feedback">Prosim, vnesite ime.</div>
        </div>

        <div class="mb-3">
            <label for="priimek" class="form-label">Priimek:</label>
            <input type="text" id="priimek" name="priimek" class="form-control" required>
            <div class="invalid-feedback">Prosim, vnesite priimek.</div>
        </div>

        <div class="mb-3">
            <label for="tip_uporabnika" class="form-label">Tip uporabnika:</label>
            <select id="tip_uporabnika" name="tip_uporabnika" class="form-select" required>
                <option value="" selected disabled>Izberi tip</option>
                <option value="student">Študent</option>
                <option value="profesor">Profesor</option>
            </select>
            <div class="invalid-feedback">Prosim, izberite tip uporabnika.</div>
        </div>

        <button type="submit" class="btn btn-primary">Registriraj se</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>
</body>
</html>
