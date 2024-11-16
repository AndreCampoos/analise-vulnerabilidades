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
        //configuração da ligação ao servidor
        $liga = mysqli_connect('localhost','root');

        //verifica a ligação ao servidor
        if(!$liga) {
            echo 'ERROR!! Falha na ligação ao servidor';
            echo "<script type='text/javascript'>alert('Falha na ligação ao servidor!')</script>";
            exit;
        }

        //Ligação à base de dados
        $escolheBD = mysqli_select_db($liga, 'vulnerabilidades');

        //Verifica a ligação à BD
        if(!$escolheBD) {
            echo 'ERROR!! Falha na ligação à base de dados';
            echo "<script type='text/javascript'>alert('Base de dados não encontrada!')</script>";
            exit;
        }
    ?>
</body>
</html>