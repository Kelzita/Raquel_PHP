<?php 
//Com pass
//Inclui o arquivo da conexão com o banco de dados
require_once "conexao.php";

//Estabelece conexão
$conexao = conectadb();

//Definição dos valores para inserção 
$nome = "Raquel Fernandes";
$endereco = "Rua Osvaldo Will, 115";
$telefone = "(41) 5555-5555";
$email = "RaquelFernandesa@teste.com";

//Prepara a consult SQL usando prepare() para evitar SQLINJECTION

$stmt = $conexao->prepare("INSERT INTO cliente (nome, endereco, telefone, email) VALUES (?,?,?,?)");

//Associa os perimetros nos valores da consulta
$stmt->bind_param("ssss", $nome, $endereco, $telefone, $email);

//Executa a inserção
if($stmt->execute()) {
    echo "Cliente adicionado com sucesso!";
} else {
    echo "Erro ao adicionar cliente: " .$stmt->error;
}
//Fecha a consulta e a conexão com o bando de dados
$stmt->close();
$conexao->close(); 
?>