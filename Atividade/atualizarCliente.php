<?php
require_once('conexao.php');

$conexao = conectarBanco();
$idCliente = $_GET['id'] ?? null;
$cliente = null;
$msgErro = "";

function buscarClientePorId($idCliente, $conexao) {
    $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
    $stmt->bindParam(":id", $idCliente, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(); 
}

if($idCliente && is_numeric($idCliente)) {
    $cliente = buscarClientePorId($idCliente, $conexao);
    if(!$cliente) {
        $msgErro = "Erro: Cliente não encontrado.";
    }
} else {
    $msgErro = "Digite o ID do cliente para buscar os dados.";
}
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function habilitarEdicao(campo) {
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>   
</head>
<body>
    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="home.php">Página Inicial</a></li>
                            <li><a class="dropdown-item" href="inserirCliente.php">Cadastrar Clientes</a></li>
                            <li><a class="dropdown-item" href="listarClientes.php">Lista de Clientes</a></li>
                            <li><a class="dropdown-item" href="deletarCliente.php">Deletar Clientes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Atualizar Cliente</h2>

                <?php if($msgErro || !$cliente) : ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($msgErro); ?></div>
                    <form action="atualizarCliente.php" method="GET" class="border p-4 rounded">
                        <div class="mb-3">
                            <label for="id" class="form-label">ID do Cliente:</label>
                            <input type="number" class="form-control" id="id" name="id" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                <?php else: ?>
                    <form action="processarAtualizacao.php" method="POST" class="border p-4 rounded">
                        <input type="hidden" name="id_cliente" value="<?php echo htmlspecialchars($cliente['id_cliente']); ?>">

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" 
                                   value="<?php echo htmlspecialchars($cliente['nome']); ?>" 
                                   readonly onclick="habilitarEdicao('nome')">
                        </div>

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço:</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" 
                                   value="<?php echo htmlspecialchars($cliente['endereco']); ?>" 
                                   readonly onclick="habilitarEdicao('endereco')">
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone:</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" 
                                   value="<?php echo htmlspecialchars($cliente['telefone']); ?>" 
                                   readonly onclick="habilitarEdicao('telefone')">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?php echo htmlspecialchars($cliente['email']); ?>" 
                                   readonly onclick="habilitarEdicao('email')">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>