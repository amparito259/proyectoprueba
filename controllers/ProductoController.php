<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/Producto.php";
require_once __DIR__ . "/../models/Categoria.php";

class ProductoController {
    private $db;
    private $producto;
    private $categoria;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
        $this->categoria = new Categoria($this->db);
    }

    public function inicio() {
        $totalProductos = $this->producto->countTotal();
        $totalActivos = $this->producto->countActivos();
        $totalCategorias = $this->categoria->count();
        require_once __DIR__ . "/../views/inicio.php";
    }

    public function listar() {
        $search = $_GET['search'] ?? '';
        $estado = $_GET['estado'] ?? 'Todos';
        $productos = $this->producto->getAll($search, $estado);
        require_once __DIR__ . "/../views/productos.php";
    }

    public function detalle() {
        $id = $_GET['id'] ?? null;
        $prod = null;
        if ($id) {
            $prod = $this->producto->getById($id);
        }
        require_once __DIR__ . "/../views/detalle.php";
    }

    public function formulario() {
        $id = $_GET['id'] ?? null;
        $prod = $id ? $this->producto->getById($id) : null;
        $categorias = $this->categoria->getAll();
        require_once __DIR__ . "/../views/registrar.php";
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_producto'] ?? null;
            
            $data = [
                'id_producto'  => $id,
                'nombre'       => $_POST['nombre'],
                'precio'       => $_POST['precio'],
                'cantidad'     => $_POST['cantidad'],
                'estado'       => $_POST['estado'],
                'categoria_id' => $_POST['categoria_id']
            ];

            if ($id) {
                $this->producto->update($data);
            } else {
                $this->producto->create($data);
            }

            header("Location: index.php?action=productos");
            exit;
        }
    }
}