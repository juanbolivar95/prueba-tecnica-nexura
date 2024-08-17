<?php

require_once __DIR__ . '/../conexion/Database.php';

class Empleado
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getConnection();
    }

    public function save($nombre, $email, $gender, $area, $description, $boletin, $roles)
    {
        try {
            $stmt = $this->pdo->query('SELECT MAX(id) AS last_id FROM empleados');
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastId = $result['last_id'] ?? 0;
            $newId = $lastId + 1;

            $stmt = $this->pdo->prepare('INSERT INTO empleados (id, nombre, email, sexo, area_id, descripcion, boletin) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$newId, $nombre, $email, $gender, $area, $description, $boletin]);

            foreach ($roles as $rol) {
                $stmt = $this->pdo->prepare('INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)');
                $stmt->execute([$newId, $rol]);
            }

            echo "Empleado guardado correctamente.";
        } catch (PDOException $e) {
            echo "Error al guardar empleado: " . $e->getMessage();
        }
    }

    public function obtenerEmpleados()
    {
        try {
            $stmt = $this->pdo->prepare('
                SELECT empleados.*, areas.nombre AS area_nombre 
                FROM empleados
                INNER JOIN areas ON empleados.area_id = areas.id
            ');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los empleados: " . $e->getMessage();
            return [];
        }
    }

    public function obtenerEmpleadoPorId($id)
    {
        try {
            $stmt = $this->pdo->prepare('
                SELECT empleados.*, areas.nombre AS area_nombre
                FROM empleados
                INNER JOIN areas ON empleados.area_id = areas.id
                WHERE empleados.id = ?
            ');
            $stmt->execute([$id]);
            $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $this->pdo->prepare('
                SELECT rol_id
                FROM empleado_rol
                WHERE empleado_id = ?
            ');
            $stmt->execute([$id]);
            $roles = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            $empleado['roles'] = $roles;

            return $empleado;
        } catch (PDOException $e) {
            echo "Error al obtener el empleado: " . $e->getMessage();
            return [];
        }
    }

    public function actualizarEmpleado($id, $nombre, $email, $gender, $area, $description, $boletin, $roles)
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE empleados SET nombre = ?, email = ?, sexo = ?, area_id = ?, descripcion = ?, boletin = ? WHERE id = ?');
            $stmt->execute([$nombre, $email, $gender, $area, $description, $boletin, $id]);

            $stmt = $this->pdo->prepare('DELETE FROM empleado_rol WHERE empleado_id = ?');
            $stmt->execute([$id]);

            foreach ($roles as $rol) {
                $stmt = $this->pdo->prepare('INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (?, ?)');
                $stmt->execute([$id, $rol]);
            }

            echo "Empleado actualizado correctamente.";
        } catch (PDOException $e) {
            echo "Error al actualizar empleado: " . $e->getMessage();
        }
    }

    public function eliminarEmpleado($id)
    {
        try {
            $stmt = $this->pdo->prepare('DELETE FROM empleado_rol WHERE empleado_id = ?');
            $stmt->execute([$id]);

            $stmt = $this->pdo->prepare('DELETE FROM empleados WHERE id = ?');
            $stmt->execute([$id]);

            echo "Empleado eliminado correctamente.";
        } catch (PDOException $e) {
            echo "Error al eliminar empleado: " . $e->getMessage();
        }
    }
}
