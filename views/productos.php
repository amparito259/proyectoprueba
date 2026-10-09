<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos · Sistema de inventario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="encabezado">
        <div class="barra">
            <a class="marca" href="index.php?action=inicio">Sistema de inventario</a>
            <nav class="menu">
                <a href="index.php?action=inicio">Inicio</a>
                <a class="actual" href="index.php?action=productos">Productos</a>
                <a href="index.php?action=registrar">Registrar</a>
            </nav>
        </div>
    </header>

    <main class="contenedor">
        <div class="encabezado-pagina">
            <div>
                <h1>Listado de productos</h1>
                <p class="resumen">Productos disponibles en el inventario.</p>
            </div>
            <a class="btn" href="index.php?action=registrar">Nuevo producto</a>
        </div>

        <form method="GET" action="index.php" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="action" value="productos">
            
            <input type="text" name="search" placeholder="Buscar por nombre o categoría..." 
                   value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" 
                   style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; flex: 1;">
            
            <?php $estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : 'Todos'; ?>
            <select name="estado" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;" onchange="this.form.submit()">
                <option value="Todos" <?php echo ($estadoFiltro === 'Todos') ? 'selected' : ''; ?>>Todos los estados</option>
                <option value="Activos" <?php echo ($estadoFiltro === 'Activos') ? 'selected' : ''; ?>>Activos (Disponible)</option>
                <option value="Inactivos" <?php echo ($estadoFiltro === 'Inactivos') ? 'selected' : ''; ?>>Inactivos / Sin Stock</option>
            </select>

            <button type="submit" class="btn">Buscar</button>
            <a href="index.php?action=productos" class="btn btn-secundario">Limpiar</a>
        </form>

        <p style="margin-bottom: 10px; font-weight: bold;">Mostrando <?php echo count($productos); ?> productos</p>

        <div class="tarjeta">
            <?php if (empty($productos)): ?>
                <p style="padding: 20px; text-align: center;">No se encontraron productos que coincidan con la búsqueda.</p>
            <?php else: ?>
                <table class="tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <?php 
                                $claseBadge = 'badge-inactivo';
                                if ($p['estado'] === 'Disponible') {
                                    $claseBadge = 'badge-activo';
                                } elseif ($p['estado'] === 'Sin Stock') {
                                    $claseBadge = 'badge-sinstock';
                                }
                            ?>
                            <tr>
                                <td><?php echo $p['id_producto']; ?></td>
                                <td><?php echo $p['nombre']; ?></td>
                                <td><?php echo $p['nombre_categoria']; ?></td>
                                <td>$<?php echo number_format($p['precio'], 0, ',', '.'); ?></td>
                                <td><?php echo $p['cantidad']; ?></td>
                                <td>
                                    <span class="<?php echo $claseBadge; ?>">
                                        <?php echo $p['estado']; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="index.php?action=detalle&id=<?php echo $p['id_producto']; ?>">Ver</a> | 
                                    <a href="index.php?action=registrar&id=<?php echo $p['id_producto']; ?>">Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <footer class="pie">Sistema de inventario · ADSO</footer>
</body>
</html>