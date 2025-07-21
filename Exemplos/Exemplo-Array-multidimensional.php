<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo - Array Multidimensional (Matriz)</title>
</head>
<body>
    <h1>Exemplo - Array Multidimensional (Matriz)</h1>
    <?php
    $musicas = array {
        array("Kid Abelha","Amanhã",1993),
        array("Ultrage A Rigor","Pelados",1985),
        array("Paralamas do Sucesso","Alagados",1987);
        for($linha=0;$linha<3;$linha++) { // percorre as linhas da matriz
            for($coluna=0;$coluna<3;$coluna++) { // percorre as colunas da matriz
                echo $musicas[$linha][$coluna] . " | "; // exibe o valor da célula da matriz
            }
            echo "<br>"; // pula uma linha após exibir todos os valores de uma linha
        }
    }
    ?>
          <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
      
    
</body>
</html>