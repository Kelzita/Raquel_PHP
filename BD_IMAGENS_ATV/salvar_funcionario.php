<?php
    // Função para redimensionar uma imagem
    function redimensionar_imagem($imagem, $largura, $altura) {

        // Obtém as dimensões originais da imagem
        // GETIMAGESIZE(): Retorna a largura e altura de uma imagem
        list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);

        // Cria uma nova imagem em branco com as novas dimensões
        // IMAGECREATETRUECOLOR(): Cria uma nova imagem em branco em alta qualidade
        $novaImagem = imagecreatetruecolor($largura, $altura);

        // Carrega a imagem original a partir do arquivo
        // IMAGECREATEFROMJPEG(): Cria uma imagem PHP a partir de um arquivo JPEG
        $imagemOriginal = imagecreatefromjpeg($imagem);

        // Copia e redimensiona a imagem original para a nova
        // IMAGECOPYRESAMPLED(): Copia e redimensiona uma imagem original para uma nova imagem
        imagecopyresampled($novaImagem, $imagemOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);

        // Inicia um buffer para guardar a imagem com o texto binário
        // OB_START(): Inicia o "output buffering" GUARDANDO A SAÍDA
        ob_start();

        // IMAGEMJPEG(): Envia a imagem para o output
        imagejpeg($novaImagem);

        // OB_GET_CLEAN: Pega o conteúdo do buffer e limpa-o
        $dadosImagem = ob_get_clean();

        // Libera a memória usada pelas imagens
        // IMAGEDESTROY(): Libera a memória da imagem criada
        imagedestroy($novaImagem);
        imagedestroy($imagemOriginal);

        // Retorna a imagem redimensionada em formato binário
        return $dadosImagem;
    }

    // Configuração do banco de dados
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'bd_imagens';

    try {
        // Conexão com o banco de dados usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Define que erros irão lançar exceções

        // Verifica se foi um post e verifca se tem arquivo 'foto'
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
            
            if ($_FILES['foto']['error'] == 0) {
                // Recebe os dados do formulário
                $nome = $_POST['nome'];  // Pega o nome do funcionário
                $telefone = $_POST['telefone'];  // Pega o telefone do funcionário
                $nomeFoto = $_FILES['foto']['name'];  // Pega o nome da imagem
                $tipoFoto = $_FILES['foto']['type'];  // Pega o tipo da imagem

                // Redimensiona a imagem
                $foto = redimensionar_imagem($_FILES['foto']['tmp_name'], 300, 400);  // TMP_NAME: É o caminho temporário

                // Insere no banco de dados usando SQL preparada
                $sql = "INSERT INTO funcionarios (nome, telefone, nome_foto, tipo_foto, foto) 
                         VALUES (:nome, :telefone, :nome_foto, :tipo_foto, :foto)";

                $stmt = $pdo->prepare($sql);  // Prepara a query para evitar ataque SQL INJECTION
                $stmt->bindParam(':nome', $nome);  // Liga os parâmetros as variáveis
                $stmt->bindParam(':telefone', $telefone);  // Liga os parâmetros as variáveis 
                $stmt->bindParam(':nome_foto', $nomeFoto);  // Liga os parâmetros as variáveis 
                $stmt->bindParam(':tipo_foto', $tipoFoto);  // Liga os parâmetros as variáveis 
                $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);  // LOB = Lange Object: Usado para dados binários com imagens

                if ($stmt->execute()) {
                    echo "Funcionário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o funcionário.";
                }
            } else {
                echo "Erro ao fazer o upload da foto. Código: " . $_FILES['foto']['error'];
            }
        }
    } catch (PDOException $e) {
        // Tratamento de exceção em caso de erro de conexão
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
        exit;
    }
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imagens</title>
</head>
<body>
    <h1>Lista de Imagens</h1>
    <a href="consulta_funcionario.php">Listar funcionários</a>
    <br><br><br>
   <adress align="center">
      <i>Raquel Fernandes - Estudante - Técnico de desenvolvimento de sistemas</i>
</adress>  
</body>

</html>