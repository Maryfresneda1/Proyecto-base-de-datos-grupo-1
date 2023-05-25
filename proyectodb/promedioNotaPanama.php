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

// Calcular el promedio de notas de los empleados de Colombia
$sql = "SELECT AVG(ce.calificacion) AS promedio_notas
        FROM CURSO_POR_EMPLEADO ce
        INNER JOIN USUARIO u ON ce.idUsuarioF2 = u.idUsuario
        INNER JOIN EMPLEADO e ON u.idUsuario = e.idUsuarioF1
        INNER JOIN EQUIPO_AREA ea ON e.idEquipoAreaF1 = ea.idEquipoArea
        INNER JOIN UBICACION ub ON ea.idUbicacionF1 = ub.idUbicacion
        INNER JOIN MUNICIPIO m ON ub.idMunicipioF1 = m.idMunicipio
        INNER JOIN LOCALIDAD l ON m.idLocalidadF1 = l.idLocalidad
        INNER JOIN PAIS p ON l.pais_Region = p.pais_Region
        WHERE p.pais_Region = 'Panama'";

$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Obtener el promedio de notas
    $row = $result->fetch_assoc();
    $promedio = $row["promedio_notas"];

    // Mostrar el promedio de notas de los empleados de Colombia
    echo "El promedio de notas de los empleados de Colombia es: " . $promedio;
} else {
    echo "No se encontraron empleados de Colombia en la base de datos.";
}

// Cerrar la conexión
$conn->close();
?>
