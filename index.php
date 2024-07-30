<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <script src="assets/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- FONTE MONTESERRAT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
    <!-- CSS DO BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- CSS LOCAL -->
    <link rel="stylesheet" href="estilos/main.css">
</head>
<body class="bg-body-tertiary">
    <!-- SVGs -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
        </symbol>
    </svg>

    <?php
        ob_start();
      // "COPIA" o arquivo banco.php
      require_once "includes/banco.php";
      require_once "includes/funcoes.php";
      require_once "includes/login.php";
      include_once "pages/toasts.php";
      include_once "pages/theme.php";
      $ordem = $_GET['o'] ?? "n";
      $chave = $_GET['c'] ?? "";
      $lista = $_GET['l'] ?? "";
      $mostrar = "";
      if(empty($_SESSION['user'])){
        $mostrar = "<a class=\"btn btn-primary\" href=\"user-login.php\" role=\"button\">Login</a>";
        } else {
            $mostrar = "
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-auto\">
                            Olá, " . $_SESSION['nome'] . "
                            <span class=\"badge text-bg-secondary\">". $_SESSION['tipo'] ."</span> 
                        </div>
                        <div class=\"col-lg-auto\">
                            <a href=\"logout.php\">
                                <span class=\"material-symbols-outlined\">
                                    logout
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            ";
        }
	  ?>
    <main>
        <header>
            <div class="d-flex flex-row justify-content-between">
                <div class="p-3">
                    <h2>Game Manager</h2>
                </div>
                <div class="p-3 d-none d-lg-block"> <!-- Ocultar em dispositivos menores -->
                    <?php
                        echo $mostrar;
                    ?>
                </div>
                <div class="p-3 d-lg-none"> <!-- Mostrar apenas em dispositivos menores -->
                    <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>

            <div class="d-flex flex-row justify-content-between">
                <div class="align-self-end ps-4 pt-4 d-none d-lg-block"> <!-- Ocultar em dispositivos menores -->
                    <ul class="nav nav-underline">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n&c=<?php echo $chave ?>">Nome</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=p&c=<?php echo $chave?>">Produtora</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n1&c=<?php echo $chave?>">Nota Alta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n2&c=<?php echo $chave?>">Nota Baixa</a>
                        </li>
                    </ul>
                </div>

                <div class="ps-4 pt-4 align-self-end d-none d-lg-block"> <!-- Ocultar em dispositivos menores -->
                    <?php
                    if(!empty($chave)){
                        echo "    
                        <span class=\"badge d-flex p-2 align-items-center text-primary-emphasis bg-primary-subtle rounded-pill\">
                                <span class=\"px-1\">$chave</span>
                                <a href=\"index.php\"><svg class=\"bi ms-1\" width=\"16\" height=\"16\"><use xlink:href=\"#x-circle-fill\"/></svg></a>
                            </span>
                        ";
                    }
                    ?>
                </div>

                <div class="pe-3 pt-4 align-self-center d-none d-lg-block"> <!-- Ocultar em dispositivos menores -->
                    <?php include_once("pages/filtrar.php"); ?>
                </div>
            </div>

            <!-- Offcanvas -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <!-- Conteúdo do offcanvas -->
                    <div class="p-3 w-100">
                        <?php
                            echo $mostrar;
                        ?>
                    </div>

                    <div class="dropdown ps-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Ordenar por
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?o=n&c=<?php echo $chave ?>">Nome</a></li>
                            <li><a class="dropdown-item" href="index.php?o=p&c=<?php echo $chave ?>">Produtora</a></li>
                            <li><a class="dropdown-item" href="index.php?o=n1&c=<?php echo $chave ?>">Nota alta</a></li>
                            <li><a class="dropdown-item" href="index.php?o=n2&c=<?php echo $chave ?>">Nota baixa</a></li>
                        </ul>
                    </div>

                    <div class="p-3">
                        <form action="index.php" method="get">
                            <legend>Filtrar</legend>
                            <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" name="c" id="busca" placeholder="Buscar" maxlength="40" <?php if(!empty($chave)) echo "value=\"". $chave ."\"" ?>>
                            </div>
                            </div>
                            <div class="mb-3">
                            <label for="disabledSelect" class="form-label">Qual a referência para a busca?</label>
                            <div class="input-group mt-2">
                                <select class="form-select" id="inputGroupSelect01" name="l">
                                    <option selected value="0">Todos</option>
                                    <option value="1">Nome</option>
                                    <option value="2">Produtora</option>
                                    <option value="3">Gênero</option>
                                </select>
                            </div>
                            </div>
                            <div class="mb-3">
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="table scroll">
            <?php
                include("pages/descricao.php");
            ?>
        </div>
        <?php include_once "pages/rodape.php"; ?>
    </main>

    <?php $banco->close(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script/script.js"></script>
    <script type="text/javascript">
        <?php if ($chave != "") { ?>
            const toastLiveExample = document.getElementById('filterMsg');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            toastBootstrap.show();
            setTimeout(() => {
                
            }, 3000);
            
        <?php } 
            ob_end_flush();
        ?>
    </script>
</body>
</html>