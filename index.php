<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="estilos/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
		// "COPIA" o arquivo banco.php
		require_once "includes/banco.php";
		require_once "includes/funcoes.php";
        $ordem = $_GET['o'] ?? "n";
	?>
    <main>
        <header>
            <div class="d-flex flex-row justify-content-between">
                <div class="p-3">
                    <h2>Game Manager</h2>
                </div>
                <div class="p-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">
                        Login
                    </button>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-between">
                <div class=" ps-4 pt-4">
                    <ul class="nav nav-underline">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n">Nome</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=p">Produtora</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n1">Nota Alta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?o=n2">Nota Baixa</a>
                        </li>
                    </ul>
                </div>
                <div class="p-3 col-sm-4">
                    <label class="visually-hidden" for="busca">Buscar</label>
                    <form action="index.php" method="get" id="busca">
                        <div class="input-group">
                            <button type="submit" class="btn btn-primary bg-secondary">
                                <span class="material-symbols-outlined">
                                    search
                                </span>
                            </button>
                            <input type="text" class="form-control" id="busca" placeholder="Buscar">
                        </div>
                    </form>
                </div>
            </div>

            <!-- MODAL DE LOGIN -->
            <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLogin" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLogin">Login</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="inputUser" class="form-label">Usuário</label>
                        <input type="text" id="inputUser" class="form-control" aria-describedby="passwordHelpBlock">
                        <label for="inputPassword5" class="form-label">Senha</label>
                        <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
                        <div id="passwordHelpBlock" class="form-text">
                            Sua senha deve ter de 8 à 20 caracteres, contendo letras e números, e não deve conter espaços, caracteres especiais ou emojis.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Efetuar login</button>
                    </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="table scroll">
            <div class="accordion p-1" id="accordionExample">
                <?php
                    $q = "SELECT j.cod, j.nome, g.genero, p.produtora, j.descricao, j.nota, j.capa FROM `jogos` j JOIN generos g ON j.genero = g.cod JOIN produtoras p ON j.produtora = p.cod ";

                    switch($ordem) {
                        case "p":
                            $q .= "ORDER BY p.produtora";
                            break;
                        case 'n1':
                            $q .= "ORDER BY j.nota DESC";
                            break;
                        case 'n2':
                            $q .= "ORDER BY j.nota ASC";
                            break;
                        default:
                            $q .= "ORDER BY j.nome";
                            break;
                        }

                    $busca = $banco->query($q);    
    
					if(!$busca){
						echo "<tr><td>Infelizmente a busca deu errado";
					}
					else{
						if($busca->num_rows == 0){
							echo "<tr><td>Nenhum registro encontrado";
						}
						else{
							while($reg = $busca->fetch_object()){
                                
								$t = thumb("$reg->capa");
                                echo "<div class=\"accordion-item\">
                                        <h2 class=\"accordion-header\">
                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#collapse", $reg->cod, "\" aria-expanded=\"false\" aria-controls=\"collapse", $reg->cod, "\">
                                                $reg->nome
                                            </button>
                                        </h2>
                                        <div id=\"collapse", $reg->cod, "\" class=\"accordion-collapse collapse\" data-bs-parent=\"#accordionExample\">
                                            <div class=\"accordion-body\">

                                                <div class=\"row\">
                                                    <div class=\"col\">
                                                        <img src=\"$t\" class=\"mini d-block w-50\" alt=\"...\">
                                                    </div>
                                                    <div class=\"col\">
                                                        <strong>$reg->nome</strong><br>
                                                        Produtora: $reg->produtora<br>
                                                        Nota: $reg->nota<br>
                                                        Genero: $reg->genero<br>
                                                        <div class=\"margin-20\">
                                                            <button type=\"button\" class=\"btn btn-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#game", $reg->cod, "\">
                                                                Descrição
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=\"modal fade\" id=\"game", $reg->cod, "\" tabindex=\"-1\" aria-labelledby=\"gameLabel", $reg->cod, "\" aria-hidden=\"true\">
                                                    <div class=\"modal-dialog modal-lg modal-dialog-scollable\">
                                                        <div class=\"modal-content\">
                                                        <div class=\"modal-header\">
                                                            <h1 class=\"modal-title fs-5\" id=\"gameLabel\">Descrição do $reg->nome</h1>
                                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                        </div>
                                                        <div class=\"modal-body\">
                                                            $reg->descricao
                                                        </div>
                                                        <div class=\"modal-footer\">
                                                            <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Fechar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
							}
						}
					}
				?>
            </div>
        </div>
        <?php include_once "rodape.php"; ?>
    </main>
    
    <?php $banco->close(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>