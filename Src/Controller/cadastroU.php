
<?php

if (isset($_REQUEST['cadastrar'])) {
    require "../Model/conexao.php";

    $nome = $_REQUEST['nome'];
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $sexo = $_REQUEST['sexo'];

    // Verificar se o email já está em uso
    $verificar_email_sql = "SELECT * FROM tb_usuario WHERE email = '$email'";
    $result = mysqli_query($conexao, $verificar_email_sql);

    if (mysqli_num_rows($result) > 0) {
        // O email já está em uso, exiba uma mensagem de erro ou redirecione de volta ao formulário de cadastro
        header('location: ../View/cadastroU.html?cadastro=erro');
       
    } else {
        // O email não está em uso, prossiga com a inserção no banco de dados
        $inserir_sql = "INSERT INTO tb_usuario (nome, email, senha, sexo) VALUES ('$nome', '$email', '$senha','$sexo')";
        if (mysqli_query($conexao, $inserir_sql)) {
            mysqli_close($conexao);
            // aqui seria colocado a mensagem em formato de pop-up 

            header('location: ../View/login.html?cadastro=success');

            
        } else {
            echo "Erro ao cadastrar o usuário.";

        }
    }
    
    
}

