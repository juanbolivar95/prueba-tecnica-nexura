<?php

require_once '../models/Empleado.php';

class EmpleadoController
{
    private $model;

    public function __construct()
    {
        $this->model = new Empleado();
    }

    public function crearEmpleado($data)
    {
        $nombre = $data['name'];
        $email = $data['email'];
        $gender = $data['gender'];
        $area = $data['area'];
        $description = $data['description'];
        $boletin = isset($data['boletin']) ? '1' : '0';
        $roles = isset($data['rol']) ? $data['rol'] : [];

        $this->model->save($nombre, $email, $gender, $area, $description, $boletin, $roles);
    }

    public function obtenerEmpleados()
    {
        return $this->model->obtenerEmpleados();
    }

    public function obtenerEmpleadoPorId($id)
    {
        return $this->model->obtenerEmpleadoPorId($id);
    }

    public function actualizarEmpleado($id, $data)
    {
        $nombre = $data['name'];
        $email = $data['email'];
        $gender = $data['gender'];
        $area = $data['area'];
        $description = $data['description'];
        $boletin = isset($data['boletin']) ? '1' : '0';
        $roles = isset($data['rol']) ? $data['rol'] : [];

        $this->model->actualizarEmpleado($id, $nombre, $email, $gender, $area, $description, $boletin, $roles);
    }

    public function eliminarEmpleado($id)
    {
        $this->model->eliminarEmpleado($id);
        header('Location: ../index.php?status=deleted');
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EmpleadoController();

    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $controller->eliminarEmpleado($_POST['id']);
    } elseif (isset($_POST['id']) && !empty($_POST['id'])) {
        $controller->actualizarEmpleado($_POST['id'], $_POST);
        header('Location: ../views/editarEmpleado.php?id=' . $_POST['id'] . '&status=success');
        exit();
    } else {
        $controller->crearEmpleado($_POST);
        header('Location: ../views/crearEmpleado.php?status=created');
        exit();
    }
}