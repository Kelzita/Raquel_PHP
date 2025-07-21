<?php 
$bdServidor = '127.0.0.1'; //localhost:8080
$bdUsuario = 'root'; // usuario do banco
$bdSenha = '';  // senha, geralmente vazia
$BdBanco = 'raquel_fernandes'; // nome do banco a se conectar 

$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $BdBanco); //conexao
if (mysqli_connect_errno()) {
    echo "Problemas para conectar no banco verifique os dados!";
    die();
} 
?>
