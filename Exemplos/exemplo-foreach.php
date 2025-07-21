<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo Foreach - 1</title>
</head>
<body>
    <?php
    $cores = array("Amarelo","Vermelho","Verde","Azul"); // cria um array com 4 cores
    // o array é uma estrutura de dados que armazena múltiplos valores em uma única variável
    foreach($cores as $cor) { // percorre o array, e o as define o nome da variável que receberá o valor de cada iteração
        // $cor recebe o valor de cada iteração do array $cores
        echo "Cor: $cor <br>"; // exibe o valor da variável $cor
    }
    ?>  
    <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
    
</body>
</html> 