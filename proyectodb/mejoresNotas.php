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
$sql = "SELECT empleado.primerNombre, empleado.primerApellido, curso_por_empleado.calificacion
        FROM curso_por_empleado
        JOIN empleado ON curso_por_empleado.idEmpleado = empleado.idEmpleado
        ORDER BY curso_por_empleado.calificacion DESC
        LIMIT 10";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar la tabla con los empleados y sus calificaciones
    echo "<table>
            <tr>
                <th>Nombre del empleado</th>
                <th>Calificación</th>
            </tr>";

    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["primerNombre"] . " " . $row["primerApellido"] . "</td>";
        echo "<td>" . $row["calificacion"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron empleados con calificaciones.";
}

// Cerrar la conexión
$conn->close();
?>
