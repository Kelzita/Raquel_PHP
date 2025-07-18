<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo Post</title>
    <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
        }
    </style>
</head>
<body>
    <form method="post" action="cripto.php">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Limpar" name="limpar">
        <br>
    </form>
    <br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
</body>
</html>