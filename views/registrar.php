<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo (isset($prod) && $prod) ? 'Editar' : 'Registrar'; ?> · Sistema de inventario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="encabezado">
        <div class="barra">
            <a class="marca" href="index.php?action=inicio">Sistema de inventario</a>
            <nav class="menu">
                <a href="index.php?action=inicio">Inicio</a>
                <a href="index.php?action=productos">Productos</a>
                <a class="actual" href="index.php?action=registrar">Registrar</a>
            </nav>
        </div>
    </header>

    <main class="contenedor">
        <h1><?php echo (isset($prod) && $prod) ? 'Editar producto' : 'Registrar producto'; ?></h1>
        <p class="resumen">Completa los datos para <?php echo (isset($prod) && $prod) ? 'actualizar el' : 'agregar un'; ?> producto al inventario.</p>

        <form id="form-producto" class="tarjeta" action="index.php?action=guardar" method="POST">
            <?php if (isset($prod) && $prod): ?>
                <input type="hidden" name="id_producto" value="<?php echo $prod['id_producto']; ?>">
            <?php endif; ?>

            <div class="campo">
                <label for="nombre">Nombre del producto</label>
                <p class="ayuda">Ingresa el nombre comercial del producto.</p>
                <input type="text" id="nombre" name="nombre" value="<?php echo isset($prod['nombre']) ? $prod['nombre'] : ''; ?>" required>
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input type="number" step="0.01" id="precio" name="precio" value="<?php echo isset($prod['precio']) ? $prod['precio'] : ''; ?>" required min="0">
            </div>

            <div class="campo">
                <label for="cantidad">Cantidad disponible</label>
                <input type="number" id="cantidad" name="cantidad" value="<?php echo isset($prod['cantidad']) ? $prod['cantidad'] : '0'; ?>" required min="0">
            </div>

            <div class="campo">
                <label for="estado">Estado</label>
                <?php $estadoActual = isset($prod['estado']) ? $prod['estado'] : ''; ?>
                <select id="estado" name="estado" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="Disponible" <?php echo ($estadoActual === 'Disponible') ? 'selected' : ''; ?>>Disponible</option>
                    <option value="Sin Stock" <?php echo ($estadoActual === 'Sin Stock') ? 'selected' : ''; ?>>Sin Stock</option>
                    <option value="Inactivo" <?php echo ($estadoActual === 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <div class="campo">
                <label for="categoria_id">Categoría</label>
                <?php $catActual = isset($prod['categoria_id']) ? $prod['categoria_id'] : ''; ?>
                <select id="categoria_id" name="categoria_id" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id_categoria']; ?>" <?php echo ($catActual == $cat['id_categoria']) ? 'selected' : ''; ?>>
                            <?php echo $cat['nombre_categoria']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin-top: 20px;">
                <button type="submit" class="btn"><?php echo (isset($prod) && $prod) ? 'Actualizar Producto' : 'Guardar Producto'; ?></button>
                <a href="index.php?action=productos" class="btn btn-secundario">Cancelar</a>
            </div>
        </form>
    </main>

    <footer class="pie">Sistema de inventario · ADSO</footer>
</body>
</html>