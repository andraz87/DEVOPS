<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dodaj nov termin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-4">
    <h2 class="mb-4">Dodaj nov termin</h2>

    <form method="post" action="<?= BASE_URL ?>dodaj" class="needs-validation" novalidate>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="naslov" class="form-label">Naslov:</label>
                <input type="text" id="naslov" name="naslov" class="form-control" required />
                <div class="invalid-feedback">Prosim, vnesite naslov.</div>
            </div>

            <div class="col-md-6">
                <label for="dan" class="form-label">Dan v tednu:</label>
                <select id="dan" name="dan" class="form-select" required>
                    <option value="" disabled selected>Izberite dan</option>
                    <option value="1">Ponedeljek</option>
                    <option value="2">Torek</option>
                    <option value="3">Sreda</option>
                    <option value="4">Četrtek</option>
                    <option value="5">Petek</option>
                    <option value="6">Sobota</option>
                    <option value="0">Nedelja</option>
                </select>
                <div class="invalid-feedback">Prosim, izberite dan v tednu.</div>
            </div>

            <div class="col-md-6">
                <label for="zacetek" class="form-label">Od (ura):</label>
                <input type="time" id="zacetek" name="zacetek" class="form-control" required />
                <div class="invalid-feedback">Prosim, vnesite začetni čas.</div>
            </div>

            <div class="col-md-6">
                <label for="konec" class="form-label">Do (ura):</label>
                <input type="time" id="konec" name="konec" class="form-control" required />
                <div class="invalid-feedback">Prosim, vnesite končni čas.</div>
            </div>

            <div class="col-md-6">
                <label for="lokacija" class="form-label">Lokacija:</label>
                <input type="text" id="lokacija" name="lokacija" class="form-control" required />
                <div class="invalid-feedback">Prosim, vnesite lokacijo.</div>
            </div>

            <div class="col-md-6">
                <label for="kapaciteta" class="form-label">Kapaciteta:</label>
                <input type="number" id="kapaciteta" name="kapaciteta" min="1" class="form-control" required />
                <div class="invalid-feedback">Prosim, vnesite kapaciteto (vsaj 1).</div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Dodaj termin</button>
        </div>
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
