<?php
include 'conexion.php';


$curso_id = $_GET['curso_id'] ?? null;
$curso_nombre = 'Curso no encontrado';
$inscritos = []; 

if ($curso_id) {

    $stmt_curso = $mysqli->prepare("SELECT nombre FROM cursos WHERE id = ?");
    $stmt_curso->bind_param("i", $curso_id);
    $stmt_curso->execute();
    $resultado_curso = $stmt_curso->get_result();

    if ($resultado_curso->num_rows > 0) {
        $curso = $resultado_curso->fetch_assoc();
        $curso_nombre = $curso['nombre'];
    }

    $stmt_curso->close();

    
    $stmt_inscritos = $mysqli->prepare("SELECT nombre, apellido,correo,fecha_inscripcion FROM inscritos WHERE curso_id = ?");
    $stmt_inscritos->bind_param("i", $curso_id);
    $stmt_inscritos->execute();
    $resultado_inscritos = $stmt_inscritos->get_result();

    while ($inscrito = $resultado_inscritos->fetch_assoc()) {
        $inscritos[] = $inscrito;
    }

    $stmt_inscritos->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Exitoso</title>
    <script src="https://kit.fontawesome.com/dc6b1e6fb0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="contenedorExito">
    <div class="conten-exito">
        <div>
            <i class="fa-solid fa-circle-check"></i>
            <h1>¡FELICITACIONES!</h1>
        </div>
        <div>
            <p>¡Su registro al curso "<?php echo htmlspecialchars($curso_nombre); ?>" fue exitoso!</p>
            <?php if (!empty($inscritos)) { ?>
                <h2>Lista de inscritos:</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Fecha de Inscripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($inscritos as $inscrito) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($inscrito['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($inscrito['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($inscrito['correo']); ?></td>
                                <td><?php echo htmlspecialchars($inscrito['fecha_inscripcion']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No hay personas inscritas en este curso todavía.</p>
            <?php } ?>
            <br>
            <a href="index.php"><button>Excelente</button></a>
        </div>
    </div>
</body>

</html>