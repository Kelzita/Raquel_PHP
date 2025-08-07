//CONEXAO COM O BANCO DE DADOS
    $host = 'localhost';
    $dbname = 'bd_imagens';
    $username = 'root';
    $password = '';

    try{
        // Conexão com o Banco de Dados usando PDO.
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define que erros vão lançar exceçoes.

        // RECUPERA TODOS OS FUNCIONÁRIOS DO BANCO DE DADOS.
        $sql = "SELECT id, nome FROM funcionarios";
        $stmt = $pdo->prepare($sql); //PREPARA A INSTRUÇÃO SQL PARA EXECUÇÃO 
        $stmt->execute(); //EXECUTA A INSTRUÇÃO SQL;
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC); // busca todos os resultados como uma matriz associativa

        // Vrifica se foi solicitado a exclusão de um funcionario
        if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['excluir_id'])){
            $excluir_id = $_POST['excluir_id'];
            $sql_excluir = "DELETE FROM funcionarios WHERE id = :id";
            $stmt_excluir = $PDO->prepare($sql_excluir);
            $stmt_excluir->bindParam(':id', $excluir_id, PDO::PARAM_INT);

            //Redireciona para evitar reenvio do formulário
            header("Location: ". $_SERVER['PHP_SELF']);
            exit();
        }
    } catch(PDOException $e) {
        echo "Erro: " .$e->getMessage(); //EXIBE A MENSAGEM DE ERRO SE A CONEXAO OU A CONSULTA FALHAR
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Consulta de Funcionários</h1>

    <ul>
        <?php foreach($funcionarios as $funcionario): ?>
            <li>
                <!-- A linha abaixo exibe o link para visualizar os detalhees do funcionário com base no id -->
                <a href="visualizar_funcionario.php?id=<?=$funcionario['id']?>">
                <!-- A linha abaixo exibe o nome do funcionário -->
                <?=htmlspecialchars($funcionario['nome']);?>
                </a>
                <!-- Formulário para excluir funcionários -->
                 <form method="POST" style="display: inline;">
                    <input type="hidden" name="exluir_id" value="<?=$funcionario['id']?>">
                    <button type="submit">Excluír</button> 
                 </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>