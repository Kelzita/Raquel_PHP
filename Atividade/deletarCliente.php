<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <li><a class="dropdown-item" href="listarClientes.php">Lista de Clientes</a></li>
                            <li><a class="dropdown-item" href="atualizarCliente.php">Alterar Clientes</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Excluir Cliente</h2>
                
                <form action="processarDelecao.php" method="POST" class="border p-4 rounded">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID do Cliente:</label>
                        <input type="number" class="form-control" id="id" name="id" required>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-danger">Excluir Cliente</button>
                    </div>
                </form>
                
                <div class="alert alert-warning mt-4">
                    <strong>Atenção:</strong> Esta açã é irreversível. Todos os dados do cliente serão permanentemente removidos.
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>