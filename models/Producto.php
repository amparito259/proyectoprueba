<?php
class Producto {
    private $conexion;
    private $table_name = "productos";

    public function __construct($db) {
        $this->conexion = $db;
    }

    public function getAll($search = '', $estado = '') {
        $query = "SELECT p.*, c.nombre_categoria 
                  FROM " . $this->table_name . " p 
                  JOIN categorias c ON p.categoria_id = c.id_categoria 
                  WHERE 1=1";

        if (!empty($search)) {
            $query .= " AND (p.nombre LIKE :search OR c.nombre_categoria LIKE :search)";
        }

        if (!empty($estado) && $estado !== 'Todos') {
            if ($estado === 'Activos') {
                $query .= " AND p.estado = 'Disponible'";
            } elseif ($estado === 'Inactivos') {
                $query .= " AND (p.estado = 'Sin Stock' OR p.estado = 'Inactivo')";
            } else {
                $query .= " AND p.estado = :estado";
            }
        }

        $query .= " ORDER BY p.id_producto ASC";
        $consulta = $this->conexion->prepare($query);

        if (!empty($search)) {
            $searchTerm = "%{$search}%";
            $consulta->bindParam(":search", $searchTerm);
        }

        if (!empty($estado) && $estado !== 'Todos' && $estado !== 'Activos' && $estado !== 'Inactivos') {
            $consulta->bindParam(":estado", $estado);
        }

        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT p.*, c.nombre_categoria 
                  FROM " . $this->table_name . " p 
                  JOIN categorias c ON p.categoria_id = c.id_categoria 
                  WHERE p.id_producto = :id LIMIT 1";
        $consulta = $this->conexion->prepare($query);
        $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, precio, cantidad, estado, categoria_id) 
                  VALUES (:nombre, :precio, :cantidad, :estado, :categoria_id)";
        $consulta = $this->conexion->prepare($query);
        return $consulta->execute([
            ':nombre' => $data['nombre'],
            ':precio' => $data['precio'],
            ':cantidad' => $data['cantidad'],
            ':estado' => $data['estado'],
            ':categoria_id' => $data['categoria_id']
        ]);
    }

    public function update($data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, precio = :precio, cantidad = :cantidad, estado = :estado, categoria_id = :categoria_id 
                  WHERE id_producto = :id";
        $consulta = $this->conexion->prepare($query);
        return $consulta->execute([
            ':id' => $data['id_producto'],
            ':nombre' => $data['nombre'],
            ':precio' => $data['precio'],
            ':cantidad' => $data['cantidad'],
            ':estado' => $data['estado'],
            ':categoria_id' => $data['categoria_id']
        ]);
    }

    public function countTotal() {
        $consulta = $this->conexion->prepare("SELECT COUNT(*) as total FROM " . $this->table_name);
        $consulta->execute();
        return $consulta->fetch()['total'];
    }

    public function countActivos() {
        $consulta = $this->conexion->prepare("SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE estado = 'Disponible'");
        $consulta->execute();
        return $consulta->fetch()['total'];
    }
}