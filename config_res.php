<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>config</title>
</head>
<body>
    <?php
        $conn = new mysqli('localhost', 'root', '', 'vulnerabilidades');

	// Verifica a ligação ao banco de dados
	if ($conn->connect_error) {
    		die("Erro de conexão: " . $conn->connect_error);
	}
    ?>
</body>
</html>