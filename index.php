<!DOCTYPE html>
<html>
<head>
	<title>Tablero de Ajedrez</title>
	<link rel="stylesheet" type="text/css" href="./libs/css/styles.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			// Cada 2 segundos, actualizar la ventana de chat
			setInterval(function() {
				$('#chat-box').load('chat.php #chat-box');
			}, 2000);
		});
	</script>
</head>
<body>

<!-- Tablero de ajedrez -->
<table>
		<?php
		// Definimos el tamaño del tablero
		$board_size = 8;

		// Creamos un array para almacenar el estado del tablero
		$board = array();

		// Creamos un array con las letras que se usan para nombrar las columnas
		$column_letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H');

		// Generamos el tablero de ajedrez
		for ($row = 0; $row < $board_size; $row++) {
		  echo '<tr>';
		  for ($col = 0; $col < $board_size; $col++) {
		    // Agregamos una clase CSS para colorear las celdas de manera alternada
		    if ($row % 2 == 0 && $col % 2 == 0 || $row % 2 != 0 && $col % 2 != 0) {
		      $class = 'white';
		    } else {
		      $class = 'black';
		    }

		    // Agregamos una clase CSS para indicar si la celda contiene una pieza de ajedrez
		    if ($row == 0 || $row == 1) {
		      $piece_class = 'black-piece';
		    } else if ($row == 6 || $row == 7) {
		      $piece_class = 'white-piece';
		    } else {
		      $piece_class = '';
		    }

		    // Agregamos una clase CSS para identificar la celda por su posición en el tablero
		    $position_class = 'cell-' . $column_letters[$col] . ($board_size - $row);

		    // Imprimimos la celda
		    echo '<td class="' . $class . ' ' . $piece_class . ' ' . $position_class . '"></td>';
		  }
		  echo '</tr>';
		}
		?>
	</table>

<!-- Ventana de chat -->
<div style="float: right; width: 300px; height: 400px; overflow-y: scroll;">
	<h2>Chat</h2>
	<div id="chat-box">
		<?php
			// Mostrar los mensajes de la base de datos
			$conn = mysqli_connect('localhost', 'root', '', 'ajedrez');
			$result = mysqli_query($conn, "SELECT * FROM chat ORDER BY timestamp DESC");
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<p><strong>" . $row['username'] . ":</strong> " . $row['message'] . "</p>";
			}
			mysqli_close($conn);
		?>
	</div>
	<form method="post" action="post.php">
		<input type="text" name="username" placeholder="Nombre de usuario"><br>
		<textarea name="message" placeholder="Escribe un mensaje"></textarea><br>
		<input type="submit" value="Enviar">
	</form>
</div>

</body>
</html>
