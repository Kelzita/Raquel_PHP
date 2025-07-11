<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de Nota Aluno</title>
</head>
<body>
<?php

    $nota1 = 6.5;
    $aprovado = ($nota1 >= 7.0);
    $recuperacao = ($nota1 >= 6.0 && $nota1 < 7.0);

    if ($aprovado) {
       echo("<center>O aluno foi aprovado com honras! 😊💕</center>");
    }
    elseif ($recuperacao) {
       echo("<center>O aluno está de recuperação, melhore! 👍</center>");
    }
    else {
       echo("<center>O aluno foi reprovado! 😢</center>");
    }

?>
 <adress>
      <p  align="center"> Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br</p>
</adress>
   
</body>
</html>