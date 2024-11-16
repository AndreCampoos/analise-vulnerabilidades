<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Vulnerabilidades - Home</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="account/login.php">Sign In</a>
            </li>
            </ul>
        </div>
    </nav>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="box-create mb-md-5 col-md-4 mx-auto">
            <div class="form">
                <h2>Criar Conta</h2>
                <div class="inputBox mx-auto pt-md-3">
                    <input type="text" name="utilizador" id="iduser" required="required" autocomplete="off">
                    <span>Nome</span>
                    <i></i>
                </div>

                <div class="inputBox mx-auto">
                    <input type="email" name="email" id="email" required="required" autocomplete="off">
                    <span>E-mail</span>
                    <i></i>
                </div>

                <div class="inputBox mx-auto">
                    <input type="password" name="senha1" id="idsenha" required="required">
                    <span>Palavra-Passe</span>
                    <i></i>
                </div>

                <div class="inputBox mx-auto">
                    <input type="password" name="senha2" id="idsenha" required="required">
                    <span>Confirmar Palavra-Passe</span>
                    <i></i>
                </div>

                <input class="mx-auto" type="submit" value="Enviar">
                <div class="links mx-auto">
                    <a href="login.php">Iniciar Sessão &#10132; </a>
                </div>
            </div>
        </div>
    </form>

    <?php
        $msg = '';

        include("../config.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST"){ #Verifica se o formulário foi enviado com o método POST, ou seja, todo o texto aqui dentro só será executado quando o formulário for submetido. 
            $nome = $_POST['utilizador'];
            $password = $_POST['senha1'];
            $confirm = $_POST['senha2'];
            $email = $_POST['email'];

            if (empty ($nome) || empty ($password) || empty ($confirm) || empty ($email)) {
                echo"<script>alert('Preencha todos os campos!')</script>";
            }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo"<script>alert('Introduza um e-mail válido!')</script>";
            }elseif($password != $confirm) {
                echo"<script>alert('As passwords não correspondem!')</script>";
            }else{
                $msg=registaUtilizador($nome, $email, $password);
            }
        }

        #Esta função verifica se o e-mail já está registado na base de dados
        function mailExiste($email) {  
            include("../config.php");
            $query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
            $resultado = mysqli_query($liga, $query);
            $contar = mysqli_num_rows($resultado);
            if($contar == 0) {
                return false;
            }else{
                return true;
            }
        }

        #Esta função faz o registo do utilizador
        function registaUtilizador($nome, $email, $password) {
            $nome = ucwords(strtolower($nome));
            $pass = md5($password);
            $mailExiste = mailExiste($email);

            #Verifica se o e-mail já existe. Se já existir exibe a mensagem de erro, se não tenta fazer o registo do utilizador.
            if($mailExiste){
                echo"<script>alert('E-mail já registado, tente outro e-mail!')</script>";
            }else{
                include("../config.php");
                $query = "INSERT INTO users (name,password,email) VALUES ('$nome','$pass','$email')";
                $resultado = mysqli_query($liga,$query);
                if($resultado == true) {
                    echo"<script>alert('Utlizador registado com sucesso!')</script>";
                    header('Location:/../index.php');
                }else{
                    echo"<script>alert('Utlizador não registado!')</script>";
                }
            }
        }
    ?>
</body>
</html>