<?php

if(isset($_GET["Associar"])){
    require "../Model/conexao.php";
    
    $diasemana = $_GET['dia_semana'];
    $usuario = $_GET['id_usuario'];
    
    for($u = 0; $u < count($usuario); $u++){

        $idDoUsuario = $usuario[$u];

        for($cod_ficha = 0; $cod_ficha < count($diasemana); $cod_ficha++){
            
            if($diasemana[$cod_ficha] != -1){
                $inserir_sql = "INSERT INTO tb_ficha_usuario(cod_ficha, cod_usuario, dia) VALUES (" . $cod_ficha + 1 .", $idDoUsuario, $diasemana[$cod_ficha])";
                mysqli_query($conexao, $inserir_sql);
                header('location: ficha.php');
            }
            
            
        }
    }
    mysqli_close($conexao);
    // header('Location: ficha.php');
    
}