<?php 
//Habilita relatório detalhado de erros do MySql 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Função para conectar o banco de dados 
//Informa um objeto de comando MYSQL ou interrompe o script em caso de erro.

function conectadb() {
    //Configuração do banco de dados 

    $endereco = "localhost"; //Endereço do servidor MYSQL 
    $usuario = "root"; //Nome do usuario do banco de dados
    $senha = ""; //Senha do banco de dados
    $banco = "empresa"; // Nome do banco de dados

    try {
        //Criação da conexão
        $con = new mysqli($endereco, $usuario, $senha, $banco); 
    
        //Definição do conjunto de caracteres para evitar problemas de acentuação
        $con->set_charset("utf8mb4"); 
        return($con);
    } catch (Exception $e) {
        //Em caso de erro, exibe uma mensagem e encerra o script
        die("Erro na conexão" .Se->getMessage());
    }
}
