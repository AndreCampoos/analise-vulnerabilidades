<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Vulnerabilidades - Login</title>
    <link rel="stylesheet" href="../css/main.css?v=1.0"> <!-- ?v=1.0 para forçar a atualização da cache -->
    <link rel="icon" type="image/x-icon" href="../img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bd13738cac.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="../index.php">
        <img src="../img/icon.png" alt="Logotipo" class="logo">
      </a>
      <a href="login.php">
        <i class="fa-solid fa-user fa-lg"></i>
      </a>
    </div>
  </nav>

  <?php
        //Criar váriáveis para informar o utilizador dos erros
        $msg = $errouser = $erropsw = '';

        //A variável SUPER GLOBAL $_REQUEST guarda tanto
        //as variáveis declaradas pelo método GET, como pelo método POST.

        if ($_SERVER["REQUEST_METHOD"] == "POST") { #Verifica se a requisião quando o formulário é enviado é do tipo POST

            //Recebe os dados do formúlario e guarda-os em variáveis
            $nome=$_REQUEST['nome'];
            $senha=$_REQUEST['senha'] ;

            //verifica se os campos estão preenchidos
            if(empty($nome) || empty($senha)){

                #Atribui mensagens de erro às variáveis
                empty($nome) ? $errouser = ' *Inserir nome' : $erropsw = ' *Inserir password';
            }else{
                //Importa o ficheiro config.php no código
                include("../config.php");

                //Verifica se o par utilizador/password existe na BD
                $passw = md5($senha); //Desencripta a password para que o user possa entrar na sua conta
                $sql = "SELECT * FROM users WHERE name='$nome' AND password='$passw' LIMIT 1"; #Faz a consulta à base de dados para verificar se o par user/password existe na tabela clientes
                $resultado=mysqli_query($liga,$sql); #Executa a consulta SQL
                $nregistos=mysqli_num_rows($resultado);

                if($nregistos > 0){ //Verifica se existem registos na base de dados que correspondam aos user/password fornecidos

                    $registo = mysqli_fetch_array($resultado);

                    if ($registo["perfil"] == 'adm') {
                        session_start();
                        $_SESSION["nome"] = $registo["nome"]; #Armazena o nome do utilizador na sessão
                        $_SESSION['perfil'] = 'adm'; #Armazena o perfil "adm" na sessão
                        header('Location: admin.php');
                        exit(); #Encera o script (permite que o redirecionamento ocorra corretamente)
                    } else {
                        session_start();
                        $_SESSION["nome"] = $registo["nome"];
                        $_SESSION["coduser"] = $registo["coduser"];
                        $_SESSION['perfil'] = 'user';
                        header('Location: user.php');
                        exit();
                    }
                    
                }else{ //Se o utilizador não existe

                    echo"<script>alert('Utlizador ou Password Errados!')</script>";
                }
            }   
        }
    ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
        <div class="box col-md-4 mx-auto mt-md-5">
            <div class="form">
                <h2><b>Iniciar Sessão</b></h2>
                <div class="inputBox mx-auto pt-md-3">
                    <input type="text" name="nome" required="required" autocomplete="off">
                    <span>Nome</span>
                    <i></i>
                </div>

                <div class="inputBox mx-auto">
                    <input type="password" name="senha" id="pass" required="required">
                    <span>Palavra-Passe</span>
                    <i></i>
                </div>
 
                <input class="mx-auto" type="submit" value="Entrar" style='margin-top: 10px;'>
                <div class="links mx-auto">
                    <a href="create.php">Criar conta gratuita &#10132; </a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>