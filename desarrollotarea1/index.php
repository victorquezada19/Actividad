<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="contenedor">
        <h1>Ofrecemos cursos de programación en oferta</h1>
        <div class="lista_cursos">
            <?php
            // Incluir la conexión a la base de datos
            include 'conexion.php';

            // Consultar los cursos en la base de datos
            $sql = "SELECT id, nombre, precio FROM cursos";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                // Mostrar cursos disponibles
                while ($curso = $result->fetch_assoc()) {
                    echo "<div class='cursos-item'>";
                    echo "<h2>" . htmlspecialchars($curso['nombre']) . "</h2>";
                    echo "<p> $" . htmlspecialchars($curso['precio']) . "</p>";
                    echo "<a href='detalles.php?id=" . $curso['id'] . "'><button>Ver Detalle</button></a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay cursos disponibles en este momento.</p>";
            }

            $mysqli->close();
            ?>
        </div>
    </div>
</body>
</html>
