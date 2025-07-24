<?php 
$bdServidor = '127.0.0.1'; //localhost:8080
$bdUsuario = 'root'; // usuario do banco
$bdSenha = '';  // senha, geralmente vazia
$BdBanco = 'raquel_fernandes'; // nome do banco a se conectar 

$conexao = mysqli_connect($bdServidor, $bdUsuario, $bdSenha, $BdBanco); //conexao
if (mysqli_connect_errno()) {
    echo "Problemas para conectar no banco verifique os dados!";
    die();
}  


function buscar_tarefas($conexao) {
    $sqlBusca = 'SELECT * FROM tarefas';
    $resultado = mysqli_query($conexao, $sqlBusca);
    $tarefas = array();
    while ($tarefa = mysqli_fetch_assoc($resultado)) {
        $tarefas[] = $tarefa; 
        
    }
    return $tarefas;
}

function gravar_tarefa($conexao, $tarefa) {
    $sqlGravar = "INSERT INTO tarefas (nome, descricao,prioridade, prazo, concluida) VALUES (
    '{$tarefa['nome']}', 
    '{$tarefa['descricao']}',
    '{$tarefa['prioridade']}',
    '{$tarefa['prazo']}',
    '{$tarefa['concluida']}'
    )
    ";
    mysqli_query($conexao,$sqlGravar);
    }
?>
