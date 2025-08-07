<?php 

//Conexão com o Banco de dados
$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'bd_imagens';

try {
    // Conexão com o banco de dados usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Define que erros irão lançar exceções
    
    //Verifica se o id foi passado na URL 
    if(isset($_GET['id'])) {
        $id = $_GET['id']; //Obtem o id do funcionário através da URL

        //Recupera os dados do funcionário no Banco de Dados 
        $sql = "SELECT nome,telefone,tipo_foto, foto FROM funcionarios WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id',$id, PDO::PARAM_INT); // Vincula o valor do id ao parametro :id
        $stmt->execute(); //Executa a instrução $sql 

        //Verifica se encontrou o funcionário.
        if($stmt->rowCount() > 0) {
            //A LINHA ABAIXO BUSCA OS DADOS DOS FUNCIONÁRIOS COM UM ARRAY ASSOCIATIVO
            $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
        
            //VERIFICA SE FOI SOLICITADO A EXCLUSÃO DO FUNCIONÁRIO
            // LINHA ABAIXO VERIFICA SE OS DADOS FORAM ENVIADOS VIA FORMULÁRIO COM MÉTODO POST
            // isset: Verifica se há um valor definido na variável 
            //VERIFICA SE O FORMULÁRIO FOI ENVIADO VIA POST E SE EXISTE O CAMPO "excluir_id"

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['excluir_id'])) {
                //A LINHA ABAIXO PEGA O VALOR ID QUE FOI ENVIADO PELO FORMULÁRIO(id do funcionário a ser excluido )
                $excluir_id = $_POST['excluir_id'];

                // MONTA A QUERY SQL PARA DELETAR O FUNCIONÁRIO COM O ID CORRESPONDENTE
                $sql_excluir = "DELETE FROM funcionarios WHERE id = :id";

                // PREPARA A QUERY PARA A EXECUÇÃO SEGURA EVITANDO SQL INJECT
                $stmt_excluir = $pdo->prepare($sql_excluir);

                //ASSOCIA O VALOR ID AO PARAMETRO :ID NA QUERY GARANTINDO QUE ELE SERÁ TRATADO COMO NÚMERO
                $stmt_excluir->bindParam(':id' , $excluir_id, PDO::PARAM_INT);

                //EXECUTA A QUERY EXCLUINDO O FUNCIONÁRIO DO BANCO DE DADOS
                $stmt_excluir->execute();
                
                //REDIRECIONA PARA EVITAR REENVIO DE FUORMULÁRIO
                header("Location:consulta_funcionario.php");
                exit();
            }
            ?>
            <!DOCTYPE html>
            <html lang="PT-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Visualizar Funcionários</title>
            </head>
            <body>
                <h1>Dados do Funcionário</h1>
                <p>Nome: <?=htmlspecialchars($funcionario['nome']); ?> </p>
                <p>Telefone: <?=htmlspecialchars($funcionario['telefone']); ?> </p>
                <p>Foto:</p>
                <img src="data:<?=$funcionario['tipo_foto']?>;base64,<?=base64_encode($funcionario['foto'])?>" alt="Foto do Funcionário"/>

               <!-- Formulário para excluir funcionário -->
                <form method="POST">
                    <input type="hidden" name="excluir_id" value="<?=$id?>"/>
                    <button type="submit">Excluir</button>
             </form>
            </body>
            </html>
        <?php
        } else {
            echo "Funcionário não encontrado."
        }
    } else {
        echo "Id do Funcionário não foi fornecido.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();

}
?>