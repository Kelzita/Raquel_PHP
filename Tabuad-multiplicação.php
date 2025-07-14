<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabuada For</title>
</head>
<body>
    <h1>Tabuada - Usando For</h1>

    <?php
     $num1 = array(0,1,2,3,4,5,6,7,8,9,10);
        for($num1=1;$num1<11;$num1++) { 
            for($num2=0;$num2<11;$num2++) { 
                echo "{$num1} x {$num2} = " . $num1 * $num2 . "<br>";
            }

            echo "<br>"; 
        }
    
    ?>
    <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
    
</body>
</html>