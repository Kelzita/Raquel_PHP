<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joinville</title>
</head>
<body>
    <?php 
    $age = 16;  // Definindo a variável $age com o valor 16 
    print"Você tem " . $age. " anos <br>"; // Concatenando a string com a variável $age
    print"Você tem  $age  anos <br>"; // Concatenando a string com a variável $age usando aspas duplas
    
    print 'Você tem $age anos <br>'; // Usando aspas simples, a variável não será interpretada, sendo interpretada como uma cadeia de caracteres.
    ?>
    <?php 

    $cidade = "Joinville"; // Definindo a variável $cidade com o valor de Curitiba
    $estado = "SC"; // Definindo a variável $estado com o valor de PA
    $idade = "174"; // Definindo a variável $idade com o valor de 325
    $frase_capital = "A cidade de $cidade é uma das cidades de $estado"; // Frase com a cidade e o estado
    $frase_idade = "$cidade tem mais de $idade anos e é a Capital das Flores"; // Frase com a cidade e a idade

    echo "<h3>$frase_capital</h3>"; // Exibe a frase com a cidade e o estado
    echo "<h4>$frase_idade</h4>"; // Exibe a frase com a cidade e a idade

    # --------STRINGS INTERPRETADAS --------
    $age = 16; // Definindo a variável $age com o valor 16
    print "Hoje é o seu $ageth aniversário <br>"; // por não haver a variável $ageth definida, ele não interpretará e só aparecerá "Hoje é o seu th aniversário"
    print "Hoje é o seu ($age) th birthday <br>";    // por não haver a variável $ageth definida, ele não interpretará e só aparecerá "Hoje é o seu (16) th birthday"
?>

</body>
</html>