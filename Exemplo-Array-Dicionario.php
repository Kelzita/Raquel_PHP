<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo Array Dicionário</title>
</head>
<body>
    <?php 
     echo "<br>"; // Criando um array associativo (dicionário)
    $AmazonProducts = array(
        array("Código" => "Livro","Descrição" => "Livros", "Preço" => 50),
        array("Código" => "DVDS","Descrição" => "Filmes", "Preço" => 19),
        array("Código" => "CDS","Descrição" => "Música", "Preço" => 20)
    );
    for ($linha = 0; $linha < 3; $linha++) {
    ?>
      <p>
         |<?= $AmazonProducts[$linha]["Código"] ?>
         | <?= $AmazonProducts[$linha]["Descrição"] ?>
         |<?= $AmazonProducts[$linha]["Preço"] ?> 
     </p>
    <?php 
} 
?>

    
    
    
    
<adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
      
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    ?>
    
</body>
</html>