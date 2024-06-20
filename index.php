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
    <link rel="stylesheet" href="estilos/style.css">
</head>
<body>
    <?php
		// "COPIA" o arquivo banco.php
		require_once "includes/banco.php";
		require_once "includes/funcoes.php"
	?>
    <main>
        <header>
            <div>
                <h1>Game Manager</h1>
            </div>
            <div class="search">
                <input type="text" name="buscar" id="buscar" placeholder="Buscar">
                <label for="buscar">
                    <span class="material-symbols-outlined">
                        search
                    </span>
                </label>
            </div>
        </header>
        <div class="table scroll">
            <table>
                <tr class="header">
                    <td>ID</td>
                    <td>Capa</td>
                    <td>Jogo</td>
                    <td>ADM</td>
                </tr>
                <?php
					$busca = $banco->query("select * from jogos order by cod");
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
                                echo "<tr><td>$reg->cod";
								echo "<td><img src='$t' class='mini'>";
								echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>";
								echo "<td>Adm";
							}
						}
					}
				?>
            </table>
        </div>
        <footer></footer>
    </main>
</body>
</html>