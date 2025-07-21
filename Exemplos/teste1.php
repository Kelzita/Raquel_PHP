<?php 
    if(isset($_GET['nome']) && isset($_GET['idade'])) { 
        echo "Recebido o cliente:" .$_GET['nome'];
        echo "<br>Que tem: " .$_GET['idade'] . " anos";





    }

?>