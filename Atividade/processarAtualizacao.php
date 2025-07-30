<?php 
require_once 'conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $conexao = conectarBanco();

    $id = filter_var($_POST["id_cliente"], FILTER_SANITIZE_NUMBER_INT);
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $endereco = htmlspecialchars(trim($_POST["endereco"]));
    $telefone = htmlspecialchars(trim($_POST["telefone"]));
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

    if(!$id || !$email) { 
        die("Erro: ID inválido ou e-mail incorreto.");
    }

    $sql = "UPDATE cliente SET nome = :nome, endereco = :endereco, telefone = :telefone, email = :email WHERE id_cliente = :id";

    $stmt = $conexao->prepare($sql); 
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":endereco", $endereco);
    $stmt->bindParam(":telefone", $telefone);
    $stmt->bindParam(":email", $email);

    try {
        $stmt->execute();
        echo "Cliente atualizado com sucesso!";
    } catch (PDOException $e) {
        error_log("Erro ao atualizar cliente ". $e->getMessage());
        echo "Erro ao atualizar registro";
    }
}