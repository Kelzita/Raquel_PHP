<?php 
//Inclui o arquivo de conexão com o banco de dados
require_once "conexao.php";

//Estabelece conexão
$conexao = conectadb();

//Define a consulta SQL para buscar clientes
$sql = "SELECT id_cliente, nome, email FROM cliente";

//Executa e consulta no banco 

$result = $conexao->query($sql);

//Verfica se há registros retornados 
if ($result->num_rows > 0) {
    while($linha = $result->fetch_assoc()) {
        echo "ID: " .$linha["id_cliente"], " <br>Nome: " .$linha["nome"], "<br>Email: " .$linha["email"]. "<br/>";
    }
} else {
    echo "Nenhum cliente cadastrado."; 
}

//Fecha conexão 
$conexao->close(); 
?> 