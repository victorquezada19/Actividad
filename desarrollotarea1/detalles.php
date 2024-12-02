<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Curso</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="contenedor">

        <?php
        
        include 'conexion.php';

        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int) $_GET['id'];

       
            $sql = "SELECT * FROM cursos WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $curso = $result->fetch_assoc();

                
                echo "<div class='item-detalles'>";
                echo "<h1>" . htmlspecialchars($curso['nombre']) . "</h1>";
                echo "<p>Descripción: " . htmlspecialchars($curso['descripcion']) . "</p>";
                echo "<p>Precio: $" . htmlspecialchars($curso['precio']) . "</p>";
                echo "</div>";
            } else {
                echo "<p>Curso no encontrado.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>ID del curso no válido.</p>";
        }
        ?>

        
        <a href="index.php"><button>Inicio</button></a>
        <?php if (isset($id)) { ?>
            <a href="inscripcion.php?curso_id=<?php echo $id; ?>"><button>Inscribete al Curso</button></a>
        <?php } ?>
    </div>
</body>
</html>
