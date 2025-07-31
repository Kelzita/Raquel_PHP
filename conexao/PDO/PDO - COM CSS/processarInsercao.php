<?php 
#Back-End do Inserir Cliente 

require_once ('conexao.php');

if($_SERVER["REQUEST_METHOD"] =="POST") {
    $conexao = conectarBanco();

    $sql = "INSERT INTO cliente (nome, endereco, telefone, email ) VALUES (:nome, :endereco, :telefone, :email )";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $_POST["nome"]);
    $stmt->bindParam(":endereco", $_POST["endereco"]);
    $stmt->bindParam(":telefone", $_POST["telefone"]);
    $stmt->bindParam(":email", $_POST["email"]);

    try {
        $stmt->execute();
        echo "<script>alert('Cliente Cadastrado com sucesso!') 
        let escolha = confirm('Deseja retornar para a página de cadastro?');
        if(escolha) {
        alert('Retornando para a página de cadastro...');
        window.location.href = 'inserirCliente.php';
        } else {
         alert('Retornando para  a página inicial...');
        window.location.href = 'home.php';
        }
        </script>";
    } catch (PDOException $e) {
        error_log("Erro ao inserir cliente: ".$e->getMessage());
        echo "Erro ao cadastrar cliente";
    }

}

?>