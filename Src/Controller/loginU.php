<?php
    
    session_start();
    require "../Model/conexao.php";

    
    // Recupere os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Consulta SQL para verificar se as credenciais são válidas
    $query = "SELECT * FROM tb_usuario WHERE email = '$email' AND senha = '$senha'";
    $queryP = "SELECT * from tb_profissional where email = '$email' and senha = '$senha'";
    $result = $conexao->query($query);
    $resultP = $conexao->query($queryP);
    
    

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id_usuario'];

    $_SESSION["id_usuario"] = $id;

    header("Location: ../View/index.html");
}  
else if($resultP->num_rows > 0){
    header("location: ../Controller/ficha.php");
} 
else {
    // Senha ou usuario incorreto
   
    header("location: ../View/login.html?erro=Senha%20ou%20usuario%20invalido") ;
    }


$mysqli->close();
?>
