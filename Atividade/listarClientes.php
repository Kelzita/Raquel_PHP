<?php 
require 'conexao.php';

$conexao = conectarBanco();
$stmt = $conexao->prepare("SELECT * FROM cliente");
$stmt->execute(); 
$clientes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body>
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
                            <li><a class="dropdown-item" href="atualizarCliente.php">Alterar Clientes</a></li>
                            <li><a class="dropdown-item" href="deletarCliente.php">Deletar Clientes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mb-4">Lista de Clientes</h2>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Endereço</th>
                        <th>Telefone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clientes as $cliente) : ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente["id_cliente"]) ?></td>
                            <td><?= htmlspecialchars($cliente["nome"]) ?></td>
                            <td><?= htmlspecialchars($cliente["endereco"]) ?></td>
                            <td><?= htmlspecialchars($cliente["telefone"]) ?></td>
                            <td><?= htmlspecialchars($cliente["email"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between mt-3">
            <span class="badge bg-primary">
                Total de Clientes: <?= count($clientes) ?>
            </span>
            <a href="inserirCliente.php" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Novo Cliente
            </a>
            <a href="atualizarCliente.php" class="btn btn-success">
                <i class="bi bi-arrow-clockwise"></i> Editar Cliente
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>