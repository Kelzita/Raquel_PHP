<?php 
//Configuração do Banco de Dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "empresa_teste";

//Conexão usando MySQLI sem proteção contra SQL Injection
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

//Verifica se há erro na conexão 
if ($conexao->connect_error) {
    die("Erro de conexão:" . $conexao->connect_error); # Irá aparecer caso a conexão não seja um sucesso.
} 

//Captura os dados do formulário (nome do usuário)
$nome = $_POST["nome"];

//Executa a consulta SEM proteção contra SQL Injection
$sql = "SELECT * FROM cliente_teste WHERE nome = '$nome'";
$result = $conexao->query($sql);

// Se houver resultados, o login é considerado bem-sucedido 
if ($result->num_rows > 0) {
    header("Location: area_restrita.php");
    //Garante que o código pare aqui para evitar execução indevida
    exit();
} else {
    echo "Nome não encontrado.";
}
//Fecha a conexão 
$conexao->close(); 
?>
<br><br><br><br>
<div>
    <adress>
        <center>Raquel Fernandes- Estudante- Técnico de Desenvolvimento de Sistemas</center>
    </adress>
</div>