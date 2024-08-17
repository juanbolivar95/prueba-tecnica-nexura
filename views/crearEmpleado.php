<?php

require_once '../models/Role.php';
require_once '../models/Area.php';

$role = new Role();
$roles = $role->obtnerRoles();

$area = new Area();
$areas = $area->obtenerAreas();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Importanciones css -->
    <link rel="stylesheet" href="../../assets/vendor/libs/bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <a href="../index.php">Regresar al Inicio</a>
                <h1>Crear empleado</h1>
                <?php if (isset($_GET['status'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php if ($_GET['status'] == 'created'): ?>
                            Empleado creado correctamente.
                        <?php endif; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form id="signupForm" action="../controller/EmpleadoController.php" method="POST" class="mt-5 needs-validation">
                    <div class="mb-4 row">
                        <label for="name" class="col-sm-3 col-form-label text-end">Nombre Completo *</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <label for="email" class="col-sm-3 col-form-label text-end">Correo Electrónico *</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="gender" class="col-sm-3 col-form-label text-end">Sexo *</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="M">
                                <label class="form-check-label" for="male">
                                    Masculino
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                                <label class="form-check-label" for="female">
                                    Femenino
                                </label>
                            </div>
                            <!-- <em id="gender-error" class="error help-block"></em> -->
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="area" class="col-sm-3 col-form-label text-end">Area *</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="area" name="area">
                                <option value="" selected>Seleccione un área</option>
                                <?php foreach ($areas as $area): ?>
                                    <option value="<?php echo $area['id']; ?>"><?php echo $area['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="description" class="col-sm-3 col-form-label text-end">Descripción *</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label class="col-sm-3 col-form-label text-end"></label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="boletin" name="boletin" value="1">
                                <label class="form-check-label" for="boletin">
                                    Desea recibir boletin informativo
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="rol" class="col-sm-3 col-form-label text-end">Roles *</label>
                        <div class="col-sm-9">
                            <?php foreach ($roles as $rol): ?>
                                <div class="checkbox">
                                    <input class="form-check-input" type="checkbox" id="rol_<?= $rol['id'] ?>" name="rol[]" value="<?= $rol['id'] ?>">
                                    <label class="form-check-label" for="rol_<?= $rol['id'] ?>">
                                        <?= $rol['nombre'] ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-8 text-center">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Importanciones js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/bootstrap-5.3.3/js/bootstrap.bundle.js"></script>
    <script src="../../assets/js/jquery.validate.js"></script>
    <script src="../../assets/js/form.js"></script>
</body>

</html>