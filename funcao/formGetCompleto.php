<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Completo com Get</title>
</head>
<body>
<form method="get" action="formGetCompleto.php">
        <label>Nome</label>
        <input type="text" name="nome"/>
        <label>Idade</label>
        <input type="number" name="idade"/>
        <input type="submit" value="Enviar"/>

</form>
<?php 
    if(isset($_GET['nome']) && isset($_GET['idade'])) { 
        echo "Recebido o cliente:" .$_GET['nome'];
        echo "Que tem: " .$_GET['idade'] . " anos";





    }







?>
<br><br>
<adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
</body>
</html>