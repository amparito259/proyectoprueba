<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio · Sistema de inventario</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header class="encabezado">
        <div class="barra">
            <a class="marca" href="index.php?action=inicio">Sistema de inventario</a>
            <nav class="menu">
                <a class="actual" href="index.php?action=inicio">Inicio</a>
                <a href="index.php?action=productos">Productos</a>
                <a href="index.php?action=registrar">Registrar</a>
            </nav>
        </div>
    </header>

    <main class="contenedor">
        <h1>Inventario de productos</h1>
        <p class="resumen">Consulta las existencias, revisa el estado de cada producto y registra nuevas entradas.</p>

        <section class="rejilla">
            <article class="indicador">
                <span>Productos registrados</span>
                <strong><?php echo $totalProductos; ?></strong>
            </article>
            <article class="indicador">
                <span>Productos activos</span>
                <strong><?php echo $totalActivos; ?></strong>
            </article>
            <article class="indicador">
                <span>Categorías</span>
                <strong><?php echo $totalCategorias; ?></strong>
            </article>
        </section>

        <div class="acciones">
            <a class="btn" href="index.php?action=registrar">Registrar producto</a>
            <a class="btn btn-secundario" href="index.php?action=productos">Ver productos</a>
        </div>
    </main>

    <footer class="pie">Sistema de inventario · ADSO</footer>
</body>
</html>