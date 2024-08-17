<?php

require_once './models/Empleado.php';

$empleado = new Empleado('', '', '', '', '', '', []);
$empleados = $empleado->obtenerEmpleados();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <!-- Importanciones css -->
    <link rel="stylesheet" href="./assets/vendor/libs/bootstrap-5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Lista de empleados</h1>
                    <a href="views/crearEmpleado.php" class="btn btn-primary btn-sm"><i class="fa-solid fa-user-plus"></i> Crear</a>
                </div>
                <?php if (isset($_GET['status']) && $_GET['status'] === 'deleted'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Empleado eliminado correctamente.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="row mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fa-solid fa-user"></i> Nombre</th>
                                <th scope="col"><i class="fas fa-at"></i> Email</th>
                                <th scope="col"><i class="fas fa-venus-mars"></i> Sexo</th>
                                <th scope="col"><i class="fas fa-briefcase"></i> Área</th>
                                <th scope="col"><i class="fas fa-envelope"></i> Boletín</th>
                                <th scope="col">Modificar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($empleados)) : ?>
                                <?php foreach ($empleados as $empleado): ?>
                                    <tr class="text-capitalize">
                                        <td><?php echo $empleado['nombre']; ?></td>
                                        <td><?php echo $empleado['email']; ?></td>
                                        <td><?php echo $empleado['sexo'] != 'F' ? 'Masculino' : 'Femenino'; ?></td>
                                        <td><?php echo $empleado['area_nombre']; ?></td>
                                        <td><?php echo $empleado['boletin'] != 0 ? 'SI' : 'NO'; ?></td>
                                        <td>
                                            <a href="views/editarEmpleado.php?id=<?php echo $empleado['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                        <td>                                            
                                            <form action="../controller/EmpleadoController.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este empleado?');">
                                                <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-link text-danger p-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <h6>En estos momentos no hay datos para mostrar</h6>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Importanciones js -->
    <script src="./assets/vendor/libs/jquery/jquery.js"></script>
    <script src="./assets/vendor/libs/bootstrap-5.3.3/js/bootstrap.bundle.js"></script>
    <script src="./assets/js/jquery.validate.js"></script>
    <script src="./assets/js/form.js"></script>
</body>

</html>