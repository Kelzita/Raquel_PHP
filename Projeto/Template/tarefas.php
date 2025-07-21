<?php 
session_start(); 

if(isset($_GET['nome']) && $_GET['nome'] != '') {
    $tarefa = array();

    $tarefa['nome'] = $_GET['nome'];        

if(isset($_GET['descricao'])) {
    $tarefa['descricao'] = $_GET['descricao'];
} else {
    $tarefa['descricao'] = '';
}
if(isset($_GET['prazo'])) {
    $tarefa['prazo'] = $_GET['prazo'];
} else {
    $tarefa['prazo'] = '';
}
$tarefa['prioridade'] = $_GET['prioridade'];

if(isset($_GET['concluida'])) {
    $tarefa['concluida'] = $_GET['concluida'];
} else {
    $tarefa['concluida'] = '';
}
$_SESSION['lista_tarefas'][] = $tarefa; 

if(array_key_exists('lista_tarefas', $_SESSION)) {
    $lista_tarefas = $_SESSION['lista_tarefas']; 
} else {
    $lista_tarefas = []; 
}
include "template.php";

}

// ANTIGO: 
//if(isset($_GET['nome'])) {
   // $_SESSION['lista_tarefas'][] = $_GET['nome']; // Adiciona a nova tarefa à sessão
//}
//if(isset($_SESSION['lista_tarefas'])) {
  //  $lista_tarefas = $_SESSION['lista_tarefas']; // Recupera a lista de tarefas da sessão
//} else {
   // $lista_tarefas = array(); // Inicialia a lista de tarefas se elaa existir
//}
//include "template.php"; // Inclui o template HTML para exibir as tarefas
//?>