<?php 
require_once('conecta.php');

// OBTEM O ID DA IMAGEM DA URL, GARANTINDO QUE SEJA UM NÚMERO INTEIRO
$id_imagem = isset($_GET['id']) ? intval($_GET['id']):0;

//VERIFICA SE O ID É VÁLIDO OU SEJA, MAIOR QUE '0'

if ($id_imagem > 0) {
    //CRIAR A QUERY SEGURA USANDO O PREPARE STATEMENT 
    $queryExcluir = "DELETE FROM tabela_imagens WHERE codigo = ?";

    //PREPARA A QUERY
    $stmt = $conexao->prepare($queryExcluir);
    $stmt->bind_param("i", $id_imagem);  //DEFINE O ID COMO UM INTEIRO         
   
    //EXECCUTA A  EXCLUSÃO
    if($stmt->execute()){
        echo ("<script>alert('Imagem excluída com sucesso!');</script>");
    } else {
        die("Erro ao excluir a imagem." . $stmt->error); 
    }

    //FECHA  A CONSULTA
    $stmt->close();

} else { 
    echo ("<script>alert('ID inválido!');</script>");
}

// REDIRECIONA PAR A INDEX.PHP E GARANTE QUE O SCRIPT PARE 
header("location: index.php");
exit();
?>