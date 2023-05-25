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

// Obtener los cursos realizados por la mayor cantidad de empleados en Panamá
$sql = "SELECT c.idArticulo, c.tituloArticulo, COUNT(ce.idCursoEmpleado) AS cantidad_empleados
        FROM CURSO c
        INNER JOIN CURSO_POR_EMPLEADO ce ON c.idArticulo = ce.idArticulo
        INNER JOIN USUARIO u ON ce.idUsuarioF2 = u.idUsuario
        INNER JOIN EMPLEADO e ON u.idUsuario = e.idUsuarioF1
        INNER JOIN EQUIPO_AREA ea ON e.idEquipoAreaF1 = ea.idEquipoArea
        INNER JOIN UBICACION ub ON ea.idUbicacionF1 = ub.idUbicacion
        INNER JOIN MUNICIPIO m ON ub.idMunicipioF1 = m.idMunicipio
        INNER JOIN LOCALIDAD l ON m.idLocalidadF1 = l.idLocalidad
        INNER JOIN PAIS p ON l.pais_region = p.pais_Region
        WHERE p.pais_Region = 'Costa Rica'
        GROUP BY c.idArticulo, c.tituloArticulo
        ORDER BY cantidad_empleados DESC
        LIMIT 5";

$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos de los cursos
    echo "<table>
            <tr>
                <th>Id del curso</th>
                <th>Nombre del curso</th>
                <th>Cantidad de empleados</th>
            </tr>";

    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idArticulo"] . "</td>";
        echo "<td>" . $row["tituloArticulo"] . "</td>";
        echo "<td>" . $row["cantidad_empleados"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron cursos realizados por empleados en las sedes de la compañía en Panamá.";
}

// Cerrar la conexión
$conn->close();
?>