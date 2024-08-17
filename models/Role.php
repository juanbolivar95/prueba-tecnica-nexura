<?php

require_once '../conexion/Database.php';

class Role
{

    private $id;
    private $nombre;
    private $pdo;

    public function __construct($id = null, $nombre = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;

        $this->pdo = (new Database())->getConnection();
    }

    public function obtnerRoles()
    {
        try {
            $roles = $this->pdo->prepare('SELECT id, nombre FROM roles');
            $roles->execute();
            return $roles->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los roles " . $e->getMessage();
            return [];
        }
    }
}
