<?php 
    session_start(); // Inicia a sessão
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1> 

    <form action="#" method="GET">
        <fieldset>
            <legend>Nova Tarefa: </legend>
            <label>Tarefa:
            <input type="text" name="nome" />
            </label>
            <input type="submit" value="Cadastrar"/>
        </fieldset>
    </form>
    
<?php 
  //if(isset($_GET['nome'])) {
   // echo "Nome informado: " .$_GET['nome'];
 // } 
?>


   <?php 
    $lista_tarefas = array();
        if(isset($_GET['nome'])) {
                $_SESSION['lista_tarefas'] [] = $_GET['nome'];
        }
        $lista_tarefas = array();

        if(isset($_SESSION['lista_tarefas'])) {
            $lista_tarefas = $_SESSION['lista_tarefas'];
        }

       // session_destroy(); destrói a sessão e limpa as tarefas, evitando que os dados re repitam
        
    ?>
    <table>
        <tr>
            <th>Tarefas</th>
        </tr>
        <?php foreach ($lista_tarefas as $tarefa): ?>
        <tr>
           <td><?php echo $tarefa; ?> </td>
        </tr>
        <?php endforeach; ?>
    </table>
<br><br><br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>
</body>
</html>