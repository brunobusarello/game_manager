<?php
	// instanciando um objeto com o nome banco da classe mysqli com os seguintes parâmetros de construção:
	// 1 - host
	// 2 - usuário do DB
	// 3 - senha do DB
	// 4 - nome do DB
    $banco = new mysqli("localhost", "root", "", "bd_games");

	// verifica se a conexão foi efetuada
    if($banco->connect_error) {
        echo "Encontrei um erro $banco->errno --> $banco->connect_error";
        die();
    }
	
	// transformar todos os valores em UTF-8
	$banco->query("SET NAMES 'utf8'");
	$banco->query("SET character_set_connection=utf8");
	$banco->query("SET character_set_client=utf8");
	$banco->query("SET character_set_results=utf8");
	
	
