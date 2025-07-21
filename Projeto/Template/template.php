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
        <fieldset>
            <legend>Nova Tarefa: </legend>
        <label>Tarefa:
            <input type="text" name="nome" />
        </label>
        <label>Descrição (Opcional):
            <textarea name="descricao"></textarea>
        </label>
        <label>Prazo (Opcional):
            <input type="text" name="prazo" />
        </label>
            
        </fieldset>
        <fieldset>
        <legend>Prioridade</legend>
        <label>
            <input type="radio" name="prioridade" value="baixa" checked />
            Baixa 
            <input type="radio" name="prioridade" value="media" checked />
            Média 
            <input type="radio" name="prioridade" value="alta" checked />
            Alta
        </label>
    </fieldset>
    <label>
        Tarefa concluída:
        <input type="checkbox" name="concluida" value="sim" />
    </label>
    <input type="submit" value="Cadastrar"/>
</fieldset>
  </form>
    <table>
        <tr>
            <th>Tarefas</th>
            <th>Descrição</th>
            <th>Prazo</th>
            <th>Prioridade</th>
            <th>Concluída</th>
        </tr>
        <?php foreach ($lista_tarefas as $tarefa): ?>
        <tr>
           <td><?php echo $tarefa; ?> </td>
        </tr>

        <?php endforeach; ?>
        
    </table>
 </body>
 </html> 
