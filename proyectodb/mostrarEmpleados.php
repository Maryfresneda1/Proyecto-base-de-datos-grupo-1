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

/*
// Obtener los datos de 10 empleados de la compañía
$sql = "SELECT * FROM EMPLEADO LIMIT 10";

$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos de los empleados
    echo "Datos de los 10 empleados de la compañía:<br><br>";
    while ($row = $result->fetch_assoc()) {
        echo "ID Empleado: " . $row["idEmpleado"] . "<br>";
        echo "Primer Nombre: " . $row["primerNombre"] . "<br>";
        echo "Primer Apellido: " . $row["primerApellido"] . "<br>";
        echo "Activo: " . ($row["activoEmpleado"] ? "Sí" : "No") . "<br>";
        echo "Género: " . $row["genero"] . "<br>";
        echo "Categoría Informe: " . $row["categoriaInforme"] . "<br>";
        echo "Grupo Personal: " . $row["grupoPersonal"] . "<br>";
        echo "ID Supervisor: " . $row["idSupervisorF1"] . "<br>";
        echo "ID Equipo Área: " . $row["idEquipoAreaF1"] . "<br>";
        echo "Usuario HR: " . $row["usuarioHRF1"] . "<br>";
        echo "ID Compañía: " . $row["idCompaniaF1"] . "<br>";
        echo "ID Usuario: " . $row["idUsuarioF1"] . "<br>";
        echo "------------------------------------------<br>";
    }
} else {
    echo "No se encontraron empleados en la base de datos.";
}

// Cerrar la conexión
$conn->close();
*/
?>
