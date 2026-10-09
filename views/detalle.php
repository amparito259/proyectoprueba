<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del producto · Sistema de inventario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="encabezado">
        <div class="barra">
            <a class="marca" href="index.php?action=inicio">Sistema de inventario</a>
            <nav class="menu">
                <a href="index.php?action=inicio">Inicio</a>
                <a href="index.php?action=productos">Productos</a>
                <a href="index.php?action=registrar">Registrar</a>
            </nav>
        </div>
    </header>

    <main class="contenedor">
        <h1>Detalle del producto</h1>
        
        <?php if (empty($prod)): ?>
            <div class="tarjeta">
                <p style="padding: 20px; text-align: center;">No se encontró la información del producto solicitado o el ID no existe.</p>
                <div style="text-align: center; margin-bottom: 20px;">
                    <a class="btn btn-secundario" href="index.php?action=productos">Volver al listado</a>
                </div>
            </div>
        <?php else: ?>
            <?php 
                $claseBadge = 'badge-inactivo';
                if ($prod['estado'] === 'Disponible') {
                    $claseBadge = 'badge-activo';
                } elseif ($prod['estado'] === 'Sin Stock') {
                    $claseBadge = 'badge-sinstock';
                }
            ?>
            <article class="tarjeta" style="padding: 24px;">
                <h2 style="margin-bottom: 16px;"><?php echo $prod['nombre']; ?></h2>
                
                <ul class="detalle-lista">
                    <li><strong>ID:</strong> <span><?php echo $prod['id_producto']; ?></span></li>
                    <li><strong>Categoría:</strong> <span><?php echo $prod['nombre_categoria']; ?></span></li>
                    <li><strong>Precio:</strong> <span>$<?php echo number_format($prod['precio'], 0, ',', '.'); ?></span></li>
                    <li><strong>Cantidad disponible:</strong> <span><?php echo $prod['cantidad']; ?></span></li>
                    <li><strong>Estado:</strong> 
                        <span class="<?php echo $claseBadge; ?>">
                            <?php echo $prod['estado']; ?>
                        </span>
                    </li>
                </ul>

                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <a class="btn" href="index.php?action=registrar&id=<?php echo $prod['id_producto']; ?>">Editar producto</a>
                    <a class="btn btn-secundario" href="index.php?action=productos">Volver al listado</a>
                </div>
            </article>
        <?php endif; ?>
    </main>

    <footer class="pie">Sistema de inventario · ADSO</footer>
</body>
</html>