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

// Obtener los 10 cursos en modalidad virtual realizados por la mayor cantidad de empleados en las sedes de la compañía en Colombia
$sql = "SELECT c.tituloArticulo, COUNT(e.idEmpleado) AS cantidadEmpleados
        FROM CURSO c
        INNER JOIN CURSO_POR_EMPLEADO ce ON c.idArticulo = ce.idCursoEmpleado
        INNER JOIN USUARIO u ON ce.idUsuarioF2 = u.idUsuario
        INNER JOIN EMPLEADO e ON u.idUsuario = e.idUsuarioF1
        INNER JOIN EQUIPO_AREA ea ON e.idEquipoAreaF1 = ea.idEquipoArea
        INNER JOIN UBICACION ub ON ea.idUbicacionF1 = ub.idUbicacion
        INNER JOIN MUNICIPIO m ON ub.idMunicipioF1 = m.idMunicipio
        INNER JOIN LOCALIDAD l ON m.idLocalidadF1 = l.idLocalidad
        INNER JOIN PAIS p ON l.idPaisF1 = p.idPais
        WHERE c.estadoProgreso = 'Aprovado (Virtual)' AND p.nombrePais = 'Colombia'
        GROUP BY c.idArticulo
        ORDER BY cantidadEmpleados DESC
        LIMIT 10";

$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos de los cursos
    echo "Los 10 cursos en modalidad virtual más realizados por empleados en sedes de la compañía en Colombia:<br><br>";
    while ($row = $result->fetch_assoc()) {
        echo "Título del curso: " . $row["tituloArticulo"] . "<br>";
        echo "Cantidad de empleados: " . $row["cantidadEmpleados"] . "<br>";
        echo "------------------------------------------<br>";
    }
} else {
    echo "No se encontraron cursos en modalidad virtual realizados por empleados en sedes de la compañía en Colombia.";
}

// Cerrar la conexión
$conn->close();
?>