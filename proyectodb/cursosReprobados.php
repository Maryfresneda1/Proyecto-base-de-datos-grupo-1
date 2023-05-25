<?php
// Datos de conexión a la base de datos
$dbhost = "localhost:3306";
$dbuser = "root"; // usuario de mysql
$dbpass = "root"; // contraseña de mysql
$dbname = "proyectofinaldb";  // nombre de la base de datos

// variable que guarda la conexión de la base de datos
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Test if connection occurred.
if (mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
} else {
    echo "¡Conexión exitosa a la base de datos!";
}

// Ejecutar la consulta SQL
$sql = "SELECT COUNT(*) AS cantidad_cursos_aprobados FROM curso_por_empleado WHERE calificacion >= 70";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Obtener el resultado
    $row = $result->fetch_assoc();
    $cantidadCursosAprobados = $row["cantidad_cursos_aprobados"];

    // Mostrar la cantidad de cursos aprobados por los empleados
    echo "La cantidad de cursos aprobados por los empleados es: " . $cantidadCursosAprobados;
} else {
    echo "No se encontraron cursos aprobados por los empleados.";
}

// Cerrar la conexión
$conn->close();
?>