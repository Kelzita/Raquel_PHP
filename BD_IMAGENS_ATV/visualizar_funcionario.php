<?php
    //CONEXAO COM O BANCO DE DADOS
    $host = 'localhost';
    $dbname = 'bd_imagens';
    $username = 'root';
    $password = '';

try{
    // Conexão com o Banco de Dados usando PDO.
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define que erros vão lançar exceçoes.

    //Verifica se o id foi passado na URL.
    if (isset($_GET['id'])){
        $id = $_GET['id']; // Obtem o id do funcionário através da URL.

        //Recupera os dados do funcionário no Banco de Dados.
        $sql = "SELECT nome, telefone, tipo_foto, foto FROM funcionarios WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); //vincula o valordo ID ao parametro :ID
        $stmt->execute(); // executa a instrucao sql
            
        // Verifica se encontrou o funcionário
        if ($stmt->rowCount() > 0){
            // A linha abaixo busca os dados dos funcionários com um array associativo
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

        //Verifica se foi solicitado a exclusão do funcionario;
         //Linha abaixo verifica se os dados forma enviados via formulário com o metodo posto
        // isset Verifica se há um valor definido na variável
        // Verifica se o formulário foi enviado via post e se exise o campo "excluir_id"
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir_id'])) {
            //A linha abaixo pega o valor id que foi enviado pelo formulário(id do funcionário a ser excluído)
            $excluir_id = $_POST['excluir_id'];

            //Monta a query sql para deletar o funcionário com o id correspondente.
            $sql_excluir = "DELETE FROM funcionarios WHERE id=:id";

            //Prepara a query para a execução segura evitando SQL INJECTION
            $stmt_excluir = $pdo->prepare($sql_excluir);

            // Associa o valor id ao parametro :id na query garantindo que será tratado como um número.
            $stmt_excluir->bindParam(':id', $excluir_id, PDO::PARAM_INT);

            // executa a query excluindo o funcionário do Banco de Dados.
            $stmt_excluir->execute();

            header("Location:consulta_funcionario.php");
            exit();
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar do Funcionário</title>
</head>
<body>
    <h1>Dados do Funcionário</h1>
    <p>Nome: <?=htmlspecialchars($funcionario['nome'])?></p>
    <p>Telefone: <?=htmlspecialchars($funcionario['telefone'])?></p>
    <p>Foto:</p>
    <img src="data:<?$funcionario['tipo_foto'] ?>;base64,<?=base64_encode($funcionario['foto'])?>" alt="Foto do Funcionario">

    <!-- Formulário para excluír funcionário -->
   <form method="POST">
        <input type="hidden" name="excluir_id" value="<?=$id?>">
        <button type="submit">Excluir Funcionario</button>
    </form>
</body>
</html>
<?php
    }else{
        echo "Funcionario não encontrado.";
        }
    }else{
         echo "ID do funcionário não foi fornecido.";
    }
}catch(PDOException $e){
    echo "Erro: ". $e->getMessage();
}
?>

<br><br><br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>