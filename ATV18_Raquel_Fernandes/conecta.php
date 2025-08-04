<?php 
// Credenciais  da conexão
$endereco = "localhost"; //Endereço do servidor MYSQL 
$usuario = "root"; //Nome do usuario do banco de dados
$senha = ""; //Senha do banco de dados
$bancoDados = "armazena_imagem"; // Nome do banco de dados

//Criando a conexão usando MYSQL
$conexao = new mysqli($endereco,$usuario,$senha,$bancoDados);

//Verfiica se há erro de conexão
if($conexao->connect_error) {
    die("Falha na conexão" . $conexao->connect_error);
}
?>