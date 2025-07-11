<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Switch - Usa em Login</title>
</head>
<body>

<?php 
   $s = "lampada"; //Declarando a variável e o seu valor, que nesse caso é "lampada"
   switch ($s) { // Iniciando o switch com a variável $s 
    case "casa": // Caso o $s seja "casa", ele irá exibir a mensagem
        print "A casa é amarela";   
        break;
    
    case "arvore": // Caso o $s seja "arvore", ele irá exibir a mensagem
        print "A árvore é bonita";
        break;
    
    case "lampada": // Caso o $s seja "lampada", ele irá exibir a mensagem
        print "Jõao apagou a lampada";
        break;
    
    default: // Se nenhum dos casos acima for verdadeiro, ele irá exibir a mensagem abaixo
       print "Você não selecionou";
       break;

    }




?>
     <adress>
      <p  align="center"> Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br</p>
</adress>
</body>
</html>