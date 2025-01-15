<?php
// Configuração da ligação ao servidor
$liga = mysqli_connect('localhost', 'root', ''); // Adiciona a senha correta se necessário

// Verifica a ligação ao servidor
if (!$liga) {
    die('ERROR!! Falha na ligação ao servidor: ' . mysqli_connect_error());
}

// Ligação à base de dados
$escolheBD = mysqli_select_db($liga, 'vulnerabilidades');

// Verifica a ligação à base de dados
if (!$escolheBD) {
    die('ERROR!! Falha na ligação à base de dados: ' . mysqli_error($liga));
}
?>
