<?php 
require_once('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = conectaBanco();

    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);

    if(!$id) {
        die("Erro: ID INVÁLIDO!");
    }

    $sql = "DELETE FROM cliente WHERE id_cliente = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "Cliente excluído com sucesso!";
    } catch (PDOException $e) {
        error_log("Erro ao excluir cliente: " . $e->getMessage());
        echo "Erro ao excluir cliente";
    }
}
?>