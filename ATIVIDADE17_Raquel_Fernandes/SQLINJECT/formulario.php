<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - INSEGURO</title>
</head>
<body>
    <h1> Sem Segurança</h1>
    <form action="login_inseguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form> 

    <h1> Ataque SQL Negado </h1>

    <form action="login_seguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form> 
    <div>
    <br><br><br><br><br>
    <adress>
        <center>Raquel Fernandes- Estudante- Técnico de Desenvolvimento de Sistemas</center>
    </adress>
</div>
</body>
</html>