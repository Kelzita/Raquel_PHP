<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <div class="container">
        <h1>Cadastro Funcionário</h1>
    <!-- Formulário para cadastrar um funcionário-->
     <form action="salvar_funcionario.php" method="POST" enctype="multipart/form-data">
        <!--Campo para inserir o nome do funcionário-->
        <label for="nome">Nome:</label>
        <input type="text"name="nome" id="nome" placeholder="Insira o nome" required></input>

        <!--Campo para inserir o nome do telefone do funcionário-->
        <label for="telefone">Telefone:</label>
        <input type="text"name="telefone" id="telefone" placeholder="Insira o telfone" required></input>

        
        <!--Campo para fazer upload da foto do funcionário-->
        <label for="foto">Foto:</label>
        <input type="file"name="foto" id="foto" required></input>

        <button class="botao" type="submit">Cadastrar</button>
    </div>
</form>  
<br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>
<br><br><br><br><br><br>

   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress> 
</body>
</html>