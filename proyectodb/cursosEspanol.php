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
$sql = "SELECT idArticulo, tituloArticulo, idiomaCurso FROM curso WHERE idiomaCurso = 'español'";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Crear la tabla HTML para mostrar los resultados
    echo "<table>
            <tr>
                <th>ID del curso</th>
                <th>Nombre del curso</th>
                <th>Idioma del curso</th>
            </tr>";

    // Recorrer los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["idArticulo"] . "</td>";
        echo "<td>" . $row["tituloArticulo"] . "</td>";
        echo "<td>" . $row["idiomaCurso"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron cursos en español.";
}

// Cerrar la conexión
$conn->close();
?>