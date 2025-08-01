<?php 
//Definição das credenciasi de acesso ao banco de dados 
$nomeservidor = "localhost"; // Endereço do servidor MYSQL
$usuario = "root"; // Nome de usuário do Banco
$senha = ""; // Senha do Banco
$bancodedados = "empresa"; //Nome do Banco de dados

//Criação da conexão com MySql 
$conn = mysqli_connect($nomeservidor, $usuario, $senha, $bancodedados); 

//Verificação da conexão 
if(!$conn) { // Caso a conexão falhe, exibe essa mensagem e interrompe o script
    die("Conexão falhou". mysqli_connect());
} 

// Configuração do conjunto de caracteres para evitar problemas de acentuação 
mysqli_set_charset($conn, "utf8mb4"); 

// Mensagem indicando que a conexão foi estabelecida corretamente
echo "Conexão bem sucedida!"; 

//Consulta SQL para obter clientes
$sql = "SELECT id_cliente, nome, email FROM cliente";
$result = mysqli_query($conn, $sqli);

//Verfiica se há resultados na consulta
if(mysqli_num_rows($result) > 0 ) {
    //Itera sobre os resultados e exibe os dados 
    while($linha = mysqli_fetch_assoc($result)) {
        echo "ID: " .$linha["id_cliente"], "Nome: " .$linha["nome"], "Email: " .$linha["email"]. "<br>";
    }
} else {
    echo "Nenhum resultado encontrado!";
}

//fecha conexão com o banco de dados 
mysqli_close($conn);

?>