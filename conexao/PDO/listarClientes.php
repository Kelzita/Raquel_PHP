<?php 
//PDO :)
require 'conexao.php';

$conexao = conectarBanco();
$stmt = $conexao->prepare("SELECT * FROM cliente");
$stmt -> execute(); 
$clientes = $stmt -> fetchAll();

?>