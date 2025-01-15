<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Vulnerabilidades - Home</title>
    <link rel="stylesheet" href="css/main.css?v=1.0"> <!-- ?v=1.0 para forçar a atualização da cache -->
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bd13738cac.js" crossorigin="anonymous"></script>
</head>
<body>
  <nav class="navbar navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="img/icon.png" alt="Logotipo" class="logo">
      </a>
      <a style='color: black;' href="opinion.php">Opinion</a>
      <a href="account/login.php">
        <i class="fa-solid fa-user fa-lg"></i>
      </a>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
        <!-- Formulário para enviar comentários -->
        <form action="" method="post">
            <div class="box col-md-4 mx-auto mt-md-5" style='width: 40%;'>
                <div class="form">
                    <h3 style='color: white; text-decoration: bold;'>Give us your opinion</h3>

                    <input type="text" class='mb-md-2' name="comentario" placeholder="Write your suggestion" required />
                    <button type="submit" class='mb-md-2'>Submit</button>

                    <h3 style='color: white; text-decoration: bold;'>All comments</h3>
                    <div id="comentarios">
                        <!-- Espaço para os comentários -->
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
                                echo "<p style='margin: 2px 0; line-height: 1.4; color: white;'>" . htmlspecialchars($row['conteudo']) . "</p>";
                                //echo "<p style='margin: 2px 0; line-height: 1.4; color: white;'>" . $row['conteudo'] . "</p>";
                            }
                        } else {
                            echo "<p style='color: white;'>Ainda não há comentários.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</body>
</html>
