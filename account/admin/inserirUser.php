<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Vulnerabilidades - Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/main.css?v=1.0"> <!-- ?v=1.0 para forçar a atualização da cache -->
    <link rel="icon" type="image/x-icon" href="../../img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/bd13738cac.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../../index.php">
                <img src="../../img/icon.png" alt="Logotipo" class="logo">
            </a>
            <a style='color: black;' href="../opinion.php">Opinion</a>
            <a href="account/login.php">
                <i class="fa-solid fa-user fa-lg"></i>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
        <div>
                <!-- SIDEBAR -->
                <section>
                        <table id="content" class="mt-md-5">
                            <tr>
                                <th>
                                    <a href="../admin.php">
                                        <i class='bx bxs-home'></i>
                                        <span class="text pt-md-1">Painel</span>
                                    </a>
                                </th>
                                <th>
                                    <a href="listarUser.php">
                                        <i class='bx bxs-user'></i>
                                        <span class="text pt-md-1">Utilizadores</span>
                                    </a>
                                </th>
                                <th>
                                    <a href="inserirUser.php">
                                        <i class='bx bx-plus-medical' ></i>
                                        <span class="text pt-md-1">Inserir Utilizadores</span>
                                    </a>
                                </th>
                                <th>
                                    <a href="editarUser.php">
                                        <i class='bx bxs-edit'></i>
                                        <span class="text pt-md-1">Editar Utilizadores</span>
                                    </a>
                                </th>
                                <th>
                                    <a href="apagarUser.php">
                                        <i class='bx bxs-trash-alt'></i>
                                        <span class="text pt-md-1">Apagar Utilizadores</span>
                                    </a>
                                </th>
                                <th>
                                    <a href="../logout.php">
                                        <i class='bx bx-exit'></i>
                                        <span class="text" style="text-decoration: underline !important; color: red;">Logout</span>
                                    </a>
                                </th>
                            </tr>
                        </table>
                    </section>
                    <!-- SIDEBAR -->
            </div>

            <div class="col-md-12">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <div class="box-create mb-md-5 col-md-4 mx-auto">
                        <div class="form">
                            <h2><b>Inserir Utilizador</b></h2>
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
                        </div>
                    </div>
                </form>

                <?php
                    $msg = '';

                    include("../../config.php");

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
                        include("../../config.php");
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
                            include("../../config.php");
                            $query = "INSERT INTO users (name,password,email, perfil) VALUES ('$nome','$pass','$email', 'user')";
                            $resultado = mysqli_query($liga,$query);
                            if($resultado == true) {
                                echo"<script>alert('Utlizador registado com sucesso!')</script>";
                                header('Location:../index.php');
                            }else{
                                echo"<script>alert('Utlizador não registado!')</script>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>

</body>
</html>