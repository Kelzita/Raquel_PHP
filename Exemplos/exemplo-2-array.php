<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXEMPO 2 - ARRAY</title>
</head>
<body>
    <?php
    $estados = array("PR", "SC", "RS","SP","RJ","MG","BA","RN","AM");
    echo "ORIGINAL: ";
    echo "<hr>STRTOLOWER: Converte uma string para minúsculas <br>";
    for($i = 0; $i < count($estados); $i++) {
       $estados[$i] = strtolower($estados[$i]);

    }
    echo "STRTOLOWER: ". print_r($estados);
    echo "<hr> SHIFT: Retira o primeiro elementos de um array<br>";
    echo "SHIFT: ". print_r($estados);  
    echo "<hr>POP: Extrai um elemento do final do array<br>";
    array_pop($estados);
    echo "PUSH: ". print_r($estados);
    echo "<hr>REVERSE: Retorna um array com os elemntos na ordem inversa<br>";
    $inverso = array_reverse($estados);
    echo "REVERSE: ". print_r($inverso);
    echo "<hr>SORT: Ordena um array<br>";
    sort($estados);
    echo "SORT: ". print_r($estados);
    echo "<hr> SLICE: Extrai uma parcela de um array<br>";
    $dividir = array_slice($estados, 1, 2);
    echo "SLICE: " .print_r($dividir); echo "<br>";

?>
<adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
    
</body>
</html>