<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Jogo</title>
    <link rel="shortcut icon" href="icones/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/details.css">
</head>
<body>
    <?php
        require_once "includes/banco.php";
        require_once "includes/funcoes.php";
    ?>
    <main>
        <?php
            $c = $_GET['cod'] ?? 0;
            $busca = $banco->query("select * from jogos where cod='$c'");
        ?>
        <header>
            <h1>Game Manager</h1>
            <p>Adm</p>
        </header>
        <?php
            if(!$busca){
                echo "Busca falhou! $banco->error";
            }
            else{
                if($busca->num_rows == 1){
                    $reg = $busca->fetch_object();
                    $foto = thumb("$reg->capa");
                    echo "<h2>$reg->nome</h2>";
                    echo "<div class='container'>";
                    echo "<img src='$foto'>";
                    echo "<p class='desc'>$reg->descricao</p>";
                    echo "</div>";
                }
                else{
                    echo "<tr><td>Nenhum registro encontrado";
                }
            }
        ?>
    </main>
</body>
</html>