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

    <style>
        .formLogin{
            margin: auto;
            width: 75%;
        }

        .msgAlert{
            width: 98%;
        }
    </style>
</head>
<body class="bg-body-tertiary">
    <?php
        ob_start();

      // "COPIA" o arquivo banco.php
      require_once "includes/banco.php";
      require_once "includes/funcoes.php";
      require_once "includes/login.php";
      include_once "pages/toasts.php";
      include_once "pages/theme.php";
      $u = $_POST['usuario'] ?? null;
      $s = $_POST['senha'] ?? null;
      $msg = $_GET['msg'] ?? null;
	  ?>
    <main>
        <header>
            <div class="d-flex flex-row justify-content-between">
                <div class="p-3">
                    <h2>Game Manager</h2>
                </div>
            </div>
            <?php
                if (is_null($u) || is_null($s)) {   ?>
                    <form action="user-login.php" method="post">
                        <div class="input-group mb-3 formLogin">
                            <?php
                                if($msg == '1'){
                                    echo "
                                        <div class=\"alert alert-danger msgAlert\" role=\"alert\">
                                            Senha incorreta!
                                        </div>
                                    ";
                                }
                                elseif ($msg == '2') {
                                    echo "
                                        <div class=\"alert alert-danger msgAlert\" role=\"alert\">
                                            Usuário não encontrado!
                                        </div>
                                    ";
                                }  
                            ?>
                            <div class="mb-3 w-100">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" id="usuario" name="usuario" class="form-control">
                            </div>
                            <div class="mb-3 w-100">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control" aria-describedby="passwordHelpBlock">
                                <div id="passwordHelpBlock" class="form-text">
                                   Sua senha deve ter de 8 à 20 caracteres.
                                </div>
                            </div>
                            <button type="submit" class="ms-2 btn btn-primary">Login</button>
                        </div>
                    </form>
                <?php
                } else { 
                    $q = "SELECT usuario, nome, senha, tipo FROM usuarios WHERE usuario = '$u' LIMIT 1";
                    $busca = $banco->query($q);

                    if(!$busca){
                        echo "falha ao achar usuário";
                    }
                    else {
                        if ($busca->num_rows > 0) {
                            $reg = $busca->fetch_object();
                            if (testarHash($s, $reg->senha)) {
                                $_SESSION['user'] = $reg->usuario;
                                $_SESSION['nome'] = $reg->nome;
                                $_SESSION['tipo'] = $reg->tipo;

                                header('Location: index.php');
                                exit();
                            }
                            else {
                                header('Location: user-login.php?msg=1');
                                exit();
                            }
                        }
                        else {
                            header('Location: user-login.php?msg=2');
                            exit();
                        }
                    }
                }
                ob_end_flush();
            ?>
        </header>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script/script.js"></script>
</body>