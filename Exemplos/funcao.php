<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>funcao - php</title>
</head>
<body>
    <?php
        # index 0123456789012345
        $name = "Stefanie Hatcher"; //string com o nome
        $length = strlen($name); // Retorna o tamanho da string
        $cmp = strcmp($name, "Brian Le"); //Compara duas strings
        $index = strpos($name, "e"); // Retorna a posição da primeira ocorrência de "e"
        $first = substr($name, 9, 5); // Retorna uma substring de 5 caracteres a partir do índice 9
        $name = strtoupper($name); // Converte a string para maiúsculas

 
    ?>
    <p>Nome: <?php echo $name; ?></p> <!-- Imprimiu o nome da Stefanie-->
    <p>Tamanho: <?php echo $length; ?><p> <!-- Imprime o número de caracteres! - Incluindo o SPACE -->
    <p>Comparação: <?php echo $cmp; ?></p> <!-- Imprimiu o resultado da comparação entre StefAnie e BriAn - Ou seja, ambos em 'A' - em ordem, no caso, a  primeira comparaçaõ que aparece é o 'A' -->
    <p>Ocorrência: <?php echo $index; ?></p> <!-- Imprimiu a primeira ocorrencia de e, ou seja, "stE"-->
    <p>Substring: <?php echo $first; ?></p> <!-- Imprimiu a substring de 5 caracteres a partir do caractere 9, que é um H, então resulta em  H,A,T,C,H - 5 caracteres -->
    <p>Maiúsculas: <?php echo $name; ?></p> <!-- Imprimiu o nome todo em maiúsculas, ou seja, STEFANIE HATCHER -->
 <adress>
      <p  align="center"> Raquel Fernandes / Estudante / raquel_f_brito@estudante.sesisenai.org.br</p>
</adress>
</body>
</html>