<?php 
       if(isset($_POST["enviar"]))
       {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        echo "Recebido $usuario e $senha <br>";
        // Criptografando a senha
        $cripto = MD5($senha);
        echo "Criptografada $cripto";
       }
?>