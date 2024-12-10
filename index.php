<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Mágica</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lista Mágica</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Listas de Presentes
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="?page=cadastrar-lista">Cadastrar</a></li>
                            <li><a class="dropdown-item" href="?page=listar-lista">Listar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item nav-itemA">
                        <a class="nav-link" href="#">Usuário</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
            <div class="row mt-3">
                <div class="col">
                    <?php
                    //arquivo de conexão com o banco de dados 
                    include('config.php');

                    switch (@$_REQUEST['page']) {
                        case 'cadastrar-lista':
                            include('cadastrar-lista.php');
                            break;
                        case 'editar-lista':
                            include('editar-lista.php');
                            break;
                        case 'listar-lista':
                            include('listar-lista.php');
                            break;
                        case 'salvar-lista':
                            include('salvar-lista.php');
                            break;

                        case 'cadastrar-presente':
                            include('cadastrar-presente.php');
                            break;
                        case 'editar-presente':
                            include('editar-presente.php');
                            break;
                        case 'listar-presente':
                            include('listar-presente.php');
                            break;
                        case 'salvar-presente':
                            include('salvar-presente.php');
                            break;
                        default:
                            include('home.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

</html>