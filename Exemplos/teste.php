<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teste</title>
</head>
<body>
    <?php 
        //Função usada para definir fuso horário padrão 
        date_default_timezone_set('America/Los_Angeles');
        //Manipulando o HTML e o PhP
        $data_hoje  = date("d/m/Y", time());
    ?>
<p align="center"> Hoje é dia <?php echo $data_hoje; ?> </p>
    <p align="center"> O horário é: <span id="hora"></span> </p>

    <script>
        function atualizarHora() {
            const agora = new Date();
            const horas = String(agora.getHours()).padStart(2, '0');
            const minutos = String(agora.getMinutes()).padStart(2, '0');
            const segundos = String(agora.getSeconds()).padStart(2, '0');
            document.getElementById('hora').textContent = `${horas}:${minutos}:${segundos}`;
        }
        setInterval(atualizarHora, 1000);
        atualizarHora();
    </script>