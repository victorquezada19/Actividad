<?php
include 'conexion.php';

/* if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correoElec'];
    $contrasena = $_POST['contrasena'];
    $curso_id = $_POST['curso_id'];

    // Hacer el INSERT correctamente
    $sql = "INSERT INTO inscritos (nombre, apellido, correo, contrasena, curso_id, fecha_inscripcion) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $correo, $contrasena, $curso_id);
    $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $contrasena, $curso_id);

    header("Location: registroexitoso.php");
    exit();
} */


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? null;
    $apellido = $_POST['apellido'] ?? null;
    $correo = $_POST['correoElec'] ?? null;
    $contrasena = $_POST['contrasena'] ?? null;
    $curso_id = $_POST['curso_id'] ?? null;

    if (!$nombre || !$apellido || !$correo || !$contrasena || !$curso_id) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO inscritos (nombre, apellido, correo, contrasena, curso_id, fecha_inscripcion) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $contrasena, $curso_id);
        if ($stmt->execute()) {
            echo "Registro exitoso.";
            header("Location: registroexitoso.php?curso_id=".$curso_id);
            exit();
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error;
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>

    <div class="form_inscripcion">
        <h1>Inscripción al Curso</h1>
        <!-- <form action="" method="POST">
            <input type="text" name="nombres" placeholder="Ingrese sus Nombres" required>
            <input type="text" name="apellidos" placeholder="Ingrese su Apellido" required>
            <input type="email" name="correoElec" placeholder="Correo Electrónico" required>
            <input type="password" name="contrasena" placeholder="Ingrese su Contraseña" required>
            <input type="hidden" name="curso_id" value="<?php echo isset($_GET['curso_id']) ? $_GET['curso_id'] : ''; ?>">
            <button type="submit">INSCRIBIRSE</button>
        </form> -->

        <form action="" method="POST">
            <input type="text" name="nombre" placeholder="Ingrese sus Nombres" required>
            <input type="text" name="apellido" placeholder="Ingrese su Apellido" required>
            <input type="email" name="correoElec" placeholder="Correo Electrónico" required>
            <input type="password" name="contrasena" placeholder="Ingrese su Contraseña" required>
            <input type="hidden" name="curso_id" value="<?php echo isset($_GET['curso_id']) ? $_GET['curso_id'] : ''; ?>">
            <button type="submit">INSCRIBIRSE</button>
        </form>

        <p></p>
        <a href="index.php"><button>Regresar a la lista de Cursos</button></a>
    </div>
</body>

</html>