<?php
	// Obtener los datos del formulario
	$username = $_POST['username'];
	$message = $_POST['message'];

	// Conectar a la base de datos
	$conn = mysqli_connect('localhost', 'root', '', 'ajedrez');

	// Insertar el mensaje en la base de datos
	$sql = "INSERT INTO chat (username, message) VALUES ('$username', '$message')";
	mysqli_query($conn, $sql);

	// Cerrar la conexión a la base de datos
	mysqli_close($conn);

	// Redirigir de vuelta a la página del chat
	header('Location: index.php');
?>
