<?php 
require_once('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = conectarBanco();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    if(!$id) {
        die("Erro: ID INVÁLIDO!");
    }

    $sql = "DELETE FROM cliente WHERE id_cliente = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "<script>alert('Cliente Excluído com sucesso!') 
        let escolha = confirm('Deseja retornar para a página de exclusão?');
        if(escolha) {
        alert('Retornando para a página de exclusão...');
        window.location.href = 'deletarCliente.php';
        } else {
         alert('Retornando para a página inicial...');
        window.location.href = 'home.php';
        }
        </script>";
    } catch (PDOException $e) {
        error_log("Erro ao excluir cliente: " . $e->getMessage());
        echo "Erro ao excluir cliente";
    }
}
?>

<div>
    <adress>
        <center>Raquel Fernandes- Estudante- Técnico de Desenvolvimento de Sistemas</center>
</adress> </div>