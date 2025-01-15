<!DOCTYPE html>
<html>
<head>
    <title>Teste XSS</title>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Comentários</h1>
    
    <!-- Formulário para enviar comentários -->
    <form action="" method="post">
        <input type="text" name="comentario" placeholder="Deixa o teu comentário" required />
        <button type="submit">Enviar</button>
    </form>

    <h2>Comentários Submetidos</h2>
    <div id="comentarios">
    <?php
        include("config.php"); // Inclui o config.php com a variável $liga

        // Verifica se um comentário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comentario'])) {
            $comentario = $_POST['comentario']; // Sem sanitização para simular vulnerabilidade
            
            // Inserir o comentário na base de dados
            $stmt = $liga->prepare("INSERT INTO comentarios (conteudo) VALUES (?)");
            $stmt->bind_param("s", $comentario);
            $stmt->execute();
            $stmt->close();
        }

        // Buscar e exibir os comentários armazenados
        $result = $liga->query("SELECT conteudo FROM comentarios");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row['conteudo'] . "<br>"; // Exibe o conteúdo diretamente, permitindo XSS
            }
        } else {
            echo "Ainda não há comentários.";
        }
        ?>
    </div>
</body>
</html>
