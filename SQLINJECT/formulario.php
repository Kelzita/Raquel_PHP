<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - INSEGURO</title>
</head>
<body>
<div class="form-inseguro">
    <h1> Sem Segurança</h1>
    <div class="form-inseguro">
    <form action="login_inseguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form> 

    <h1> Ataque SQL Negado </h1>

    <form action="login_seguro.php" method="POST">
        <input type="text" name="nome" placeholder="Digite seu nome">
        <button type="submit">Entrar</button>
    </form> 
</body>
</html>