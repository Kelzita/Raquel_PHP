<?php
//Função para redimensionar a imagem
function redimensionarImagem($imagem,$largura,$altura) {
    //Obtem as dimensões originais da imagem 
    //getimagemsize(): Retorna à largura e a altura de uma imagem

    list($larguraOriginal, $alturaOriginal) = getimagesize($imagem);

    //Cria uma nova iamgem em branco com as novas dimensões
    //imagecreatetruecolor(): cria uma nova imagemem branco em alta qualidade

    $novaImagem = imagecreatetruecolor($largura,$altura);

    //Carrega a imagem original (JPEG) a partir do arquiivo
    //imagecreatefromjpeg(): Cria uma imagem php a partir de um jpeg
    $imagemOriginal = imagecreatefromjpeg($imagem);

    //Copia e redimensiona a imagem original para a nova
    //imagecopyexamplet(): Copia com redimensionamemto e sua suavização  
    imagecopyexamplet($novaImagem, $imagemOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);

    //inicia com um buffer para guardar a imagem como texto binário
    //ob_start(): Inicia o ''output buffering'', guardnadoa saidda
    ob_start();

    //imagejpeg(): Envia a imagem para o output
    imagejpeg($novaImagem);

    //OB_GET_CLEAN: pega o conteudo do bufer e linpa

    $dados_imagem = OB_GET_CLEAN();

    //Libera a memoria usada pelas iamgens
    //tempimagedestroy(): Limpa a memória parqaa aa ss
    $imagedestroy($novaImagem);
    $imagedestroy($imageOriginal);

    //Retorna a imagem reidmensioda em formato binario
    return $dadosimagem;
}

//Configurando com o banco
$host = 'localhost';
$dbname = 'bd_imagens';
$username = 'root';
$password = '';

try { 
    //Conexão com o bacode dados suando o pdo
    $pdo new PDO("mysql:host=$host;dbname=$dbname" . $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define que erros vão lançar excessoe

//vrific a se te um psot e se tem aruquvio

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset ($_FILES['foto'])) {
       if($_FILES['foto']['error'] == 0) {
        $nome = $_POST['nome']; //pega o noed o funcionario
        $telefone = $_POST['telefone']; //epga o tepefone do funcionario
        $nome_foto = $_POST['nomeFoto']['name']; // pega o noem original do arquivo
        $tipoFoto = $_POST['tipoFoto']['type']; // pga o tipo MIME da iamgem 

        //REDIMENSIONA A MIAMHGEM

        $foto = redimensionarImagem($_FILES['foto']['$tmp_name'],300,400);//TMP_NAME É O CAMINH TEMPRIOARIO 

        //insere no bacno de dados ussando o sql perepraod

        $sql = "INSERT INTO funcionarios(nome,telefone,nome_foto, tipo_foto, foto) VALUES (:nome, :telefone, :none_foto,  :tipo_foto, :foto)";

        $stmt = $pdo->prepare($sql); //prerapa a query ora evitar o sql inject
        $stmt->bind_param(':nome', $nome); //liga o sparamentos a  varioveis
        $stmt->bind_param(':telefone', $telefone); //liga o sparamentos a  varioveis
        $stmt->bind_param(':nome_foto', $nome_foto); //liga o sparamentos a  varioveis
        $stmt->bind_param(':tipo_foto', $tipo_foto); //liga o sparamentos a  varioveis
        $stmt->bind_param(':foto', $foto, PDO::PARAM_LOB); //LOB = Large object, usado para dados binarios  como imagens

        if($stmt->execute()) {
            echo "Funcionário cadastrado com sucesso";

        } else {
            echo "Erro ao cadastrar o funcionário";
        }
    } else {
        echo "Erro ao fazer o upload do codigo : " .$_FILES['foto']['error'];
    }
} catch(PDOException $e) {
    echo "Erro" . $e->getMessage(); //Mostra o erro se hovuer
}

}
?>