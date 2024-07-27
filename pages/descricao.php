<div class="accordion accordion-flush p-3" id="accordionDesc">
<?php
    $q = "SELECT j.cod, j.nome, g.genero, p.produtora, j.descricao, j.nota, j.capa FROM `jogos` j JOIN generos g ON j.genero = g.cod JOIN produtoras p ON j.produtora = p.cod ";

    switch($lista){
        case "2":
            $q .= "WHERE p.produtora like '%$chave%' ";
            break;
        case "3":
            $q .= "WHERE g.genero like '%$chave%' ";
            break;
        case "1":
            $q .= "WHERE j.nome like '%$chave%' ";
            break;
        default:
            $q .= "WHERE j.nome like '%$chave%' OR p.produtora like '%$chave%' OR g.genero like '%$chave%' ";
            break;
    }

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

?>
             
             <div class="accordion-item mb-3">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $reg->cod ?>" aria-expanded="false" aria-controls="collapse<?php echo $reg->cod ?>">
                        <?php echo $reg->nome ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $reg->cod ?>" class="accordion-collapse collapse" data-bs-parent="#accordionDesc">
                    <div class="accordion-body d-flex">
                        <img src="<?php echo $t ?>" alt="<?php $reg->nome ?>" class="mini">
                        <div class="flex-column m-5">
                            <?php
                                echo "
                                    <strong>Nota: </strong> $reg->nota <br>
                                    <strong>Produtora: </strong> $reg->produtora <br>
                                    <strong>Gênero: </strong> $reg->genero <br>
                                ";
                            ?>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#descModal<?php echo $reg->cod ?>">
                                Descrição
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="descModal<?php echo $reg->cod ?>" tabindex="-1" aria-labelledby="descModalLabel<?php echo $reg->cod ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="descModalLabel<?php echo $reg->cod ?>">Descrição do <?php echo $reg->nome; ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body textJus">
                        <?php echo $reg->descricao ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                    </div>
                </div>
            </div>
            
            
            <?php
            }
        }
    }
    ?>
    </div>