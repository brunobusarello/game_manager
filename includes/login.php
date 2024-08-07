<?php
    session_start();

    if(!isset($_SESSION['user'])){   
        $_SESSION['user'] = "";
        $_SESSION['nome'] = "";
        $_SESSION['tipo'] = "";
    }

    function cripto($senha){
        $c = '';
        for($i=0; $i < strlen($senha); $i++) { 
            $letra = ord($senha[$i]) + 1;
            $c .= chr($letra);
        }
        return $c;
    }

    function gerarHash($senha) {
        $cri = cripto($senha);
        return password_hash($cri, PASSWORD_DEFAULT);
    }

    function testarHash($senha, $hash){
        $cri = cripto($senha);
        return password_verify($cri, $hash);
    }

    function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['nome']);
        unset($_SESSION['tipo']);
    }

    function is_logado(){
        if(empty($_SESSION['user'])){
            return false;
        }
        return true;
    }

    function is_admin(){
        if ($_SESSION['tipo'] == 'admin') {
            return true;
        }
        return false;
    }
    
    function is_editor(){
        if ($_SESSION['tipo'] == 'editor') {
            return true;
        }
        return false;
    }

?>