<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Exemplo Função String</title>
</head>
<body>
<?php
   
    $vogais = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
    echo "Hello world of PHP<br>";
    $cons = str_replace($vogais, "", "Hello world of PHP");
    echo "Consoantes: " . $cons . "<br>";
    $teste = "Hello world of\n";
    print "Posição da letra 'o' : ";
    print strpos($teste, "o") . "<br>";
    print "Posição da letra 'o' após 5º : ";
    print strpos($teste, "o", 5) . "<br>";
    $message =  "troca a letra uma a uma";
    echo $message . "<br>";
    $new_message = strtr($message, 'abcdef', '123456');
    echo 'Criptografando: ' . $new_message . "<br>";
    $new_message = strtr($new_message, '123456', 'abcdef');
    echo 'Desscriptografando: ' . $new_message . "<br>";
?>
<adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
    
    
</body>
</html>