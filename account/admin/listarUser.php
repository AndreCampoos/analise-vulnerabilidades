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
        <div>
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

            <div>
                <?php
                    $liga=mysqli_connect('localhost','root');
                    include("../../config.php");
                    $consultaUsers = "SELECT * FROM users";
                    $resultadoUsers = mysqli_query($liga, $consultaUsers);
                    $nUsers=mysqli_num_rows($resultadoUsers);

                    echo "<section id='content' class='mt-md-5'>";
                    echo "<main>";

                    echo "<h3>Foram encontrados $nUsers utilizadores na tabela 'users'</h3>";
                    echo "<table class='table-db ml-md-0 text-center'>";
                    echo "<tr>";
                    echo "<th>Código</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Email</th>";
                    echo "<th>Perfil</th>";
                    echo "</tr>";

                    for ($i = 0; $i < $nUsers; $i++) {
                        $registo = mysqli_fetch_assoc($resultadoUsers);
                
                        echo "<tr>";
                        echo "<td>" . $registo['coduser'] . "</td>";
                        echo "<td>" . $registo['name'] . "</td>";
                        echo "<td>" . $registo['email'] . "</td>";
                        echo "<td>" . $registo['perfil'] . "</td>";
                        echo "</tr>";
                    }
                ?>
                <script src="../../js/admin.js"></script>
            </div>
        </div>
    </div>

</body>
</html>