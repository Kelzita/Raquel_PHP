<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <h2>Cadastro de Cliente</h2>
<div class="container"> 
    <form action="processarInsercao.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required> 

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required> 
        
        <button type="submit">Cadastrar Cliente</button>
</div>
    </body>
</html>