<?php 
require_once('conexao.php');

$conexao = conectarBanco();
$busca = $_GET['busca'] ?? '';
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Cliente</title>
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
                            <li><a class="dropdown-item" href="listarClientes.php">Lista de Clientes</a></li>
                            <li><a class="dropdown-item" href="deletarCliente.php">Deletar Clientes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if(!$busca): ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Pesquisar Cliente</h2>
                    <form action="pesquisarCliente.php" method="GET" class="border p-4 rounded">
                        <div class="mb-3">
                            <label for="busca" class="form-label">Digite o ID ou Nome:</label>
                            <input type="text" class="form-control" id="busca" name="busca" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php else:
            if (is_numeric($busca)) {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente = :id");
                $stmt->bindParam(":id", $busca, PDO::PARAM_INT);
            } else {
                $stmt = $conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
                $buscaNome = "%$busca%";
                $stmt->bindParam(":nome", $buscaNome, PDO::PARAM_STR);
            }
            
            $stmt->execute();
            $clientes = $stmt->fetchAll();
            
            if (count($clientes) === 0): ?>
                <div class="alert alert-danger">Nenhum cliente encontrado.</div>
                <a href="pesquisarCliente.php" class="btn btn-secondary">Nova Pesquisa</a>
            <?php else: ?>
                <h2 class="text-center mb-4">Resultados da Pesquisa</h2>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th>Email</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($clientes as $cliente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente['id_cliente']) ?></td>
                                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                                    <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                                    <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                                    <td>
                                        <a href="atualizarCliente.php?id=<?= $cliente['id_cliente'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-3">
                    <a href="pesquisarCliente.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Nova Pesquisa
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <footer>
    <adress>
        <center>Raquel Fernandes- Estudante- Técnico de Desenvolvimento de Sistemas</center>
    </adress>
   </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>