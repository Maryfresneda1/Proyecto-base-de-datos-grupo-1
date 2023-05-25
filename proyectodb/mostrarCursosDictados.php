<?php
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
$sql = "SELECT curso.tituloArticulo AS nombre_curso
        FROM curso
        JOIN curso_por_empleado ON curso.idArticulo = curso_por_empleado.idArticulo
        LIMIT 10";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar la tabla con los datos de los cursos
    echo "<table>
            <tr>
                <th>Nombre del curso</th>
            </tr>";

    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre_curso"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron cursos dictados.";
}

// Cerrar la conexión
$conn->close();
?>
