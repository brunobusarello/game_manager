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
    <?php
      // "COPIA" o arquivo banco.php
      require_once "includes/banco.php";
      require_once "includes/funcoes.php";
      require_once "includes/login.php";
      include_once "pages/toasts.php";
      include_once "pages/theme.php";
      $ordem = $_GET['o'] ?? "n";
      $chave = $_GET['c'] ?? "";
      $lista = $_GET['l'] ?? "";
	  ?>
    <main>
        <header>
            <div class="d-flex flex-row justify-content-between">
                <div class="p-3">
                    <h2>Game Manager</h2>
                </div>
                <div class="p-3">
                    <?php
                      if(empty($_SESSION['user'])){
                        echo "
                          <a class=\"btn btn-primary\" href=\"user-login.php\" role=\"button\">Login</a>
                        ";
                      }
                      else{
                        echo "Olá, " . $_SESSION['nome'];
                      }
                      
                    ?>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <div class="align-self-end ps-4 pt-4">
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
                <div class="ps-4 pt-4 align-self-end">
                    <?php
                        if(!empty($chave)){
                            echo "
                                <div class=\"alert alert-primary p-1 d-flex\" role=\"alert\">
                                    <div class=\"align-self-center\">
                                        $chave
                                        <a href='index.php'>
                                            <span class=\"material-symbols-outlined filtrado\">
                                                close
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            ";
                        }
                    ?>
                </div>
                
                <div class="pe-3 pt-4 align-self-center">
                    <?php include_once("pages/filtrar.php"); ?>
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
            const toastLiveExample = document.getElementById('filterBtn');
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            toastBootstrap.show();
            
        <?php } ?>
    </script>
</body>
</html>