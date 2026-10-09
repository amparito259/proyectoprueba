<?php
class Categoria {
    private $conexion;
    private $table_name = "categorias";

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY nombre_categoria ASC";
        $consulta = $this->conexion->prepare($query);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $consulta = $this->conexion->prepare($query);
        $consulta->execute();
        $row = $consulta->fetch();
        return $row['total'];
    }
}