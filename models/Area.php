<?php

require_once '../conexion/Database.php';

class Area
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

    public function obtenerAreas()
    {
        try {
            $areas = $this->pdo->prepare('SELECT id, nombre FROM areas');
            $areas->execute();
            return $areas->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los areas " . $e->getMessage();
            return [];
        }
    }
}
