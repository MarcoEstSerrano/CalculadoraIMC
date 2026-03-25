<?php
$nombre = $_POST['nombre'] ?? '';
$peso = isset($_POST['peso']) ? floatval($_POST['peso']) : 0;
$estatura = isset($_POST['estatura']) ? floatval($_POST['estatura']) : 0;
$imc = 0;
$categoria = "";

if ($peso > 0 && $estatura > 0) {
    $imc = round($peso / ($estatura * $estatura), 2);
    
    if ($imc < 18.5) $categoria = "Bajo peso";
    elseif ($imc < 24.9) $categoria = "Normal";
    elseif ($imc < 29.9) $categoria = "Sobrepeso";
    else $categoria = "Obesidad";
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actividad Clase I - Programación III</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4">Calculadora de IMC - Escuela de Informática</h2>

    <div class="card p-4 shadow-sm">
        <form method="POST" id="formPrincipal">
            <div class="mb-3">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre" id="input_nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
            </div>
            <div class="row">
                <div class="col">
                    <label>Peso (kg):</label>
                    <input type="number" step="0.1" name="peso" id="input_peso" class="form-control" value="<?= $peso ?>" required>
                </div>
                <div class="col">
                    <label>Estatura (m):</label>
                    <input type="number" step="0.01" name="estatura" id="input_estatura" class="form-control" value="<?= $estatura ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3 w-100">Calcular IMC</button>
            <a href="?" class="btn btn-link mt-2 w-100 text-muted">Limpiar datos</a> 
        </form>
    </div>

    <?php if ($imc > 0): ?>
        <div class="alert alert-success mt-4 text-center">
            <h4>Resultado: <?= $imc ?> (<?= $categoria ?>)</h4>
            <button class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#modalEditar">Editar Datos</button>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="modalEditar" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" class="modal-content">
                <div class="modal-header">
                    <h5>Modificar Información</h5>
                </div>
                <div class="modal-body">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" id="modal_nombre" class="form-control mb-2" required>
                    <label>Peso (kg):</label>
                    <input type="number" step="0.1" name="peso" id="modal_peso" class="form-control mb-2" required>
                    <label>Estatura (m):</label>
                    <input type="number" step="0.01" name="estatura" id="modal_estatura" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar y Recalcular</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const modalEditar = document.getElementById('modalEditar');
        
        modalEditar.addEventListener('show.bs.modal', function () {
            // Transferencia de información entre elementos de la página y el modal 
            const nombreOrg = document.getElementById('input_nombre').value;
            const pesoOrg = document.getElementById('input_peso').value;
            const estaturaOrg = document.getElementById('input_estatura').value;

    
            document.getElementById('modal_nombre').value = nombreOrg;
            document.getElementById('modal_peso').value = pesoOrg;
            document.getElementById('modal_estatura').value = estaturaOrg;
        });
    </script>
</body>
</html>