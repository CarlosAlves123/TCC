
<?php
$servername = "localhost"; 
$username = "root";
$password = ""; 
$database = "bd_tcc"; 

// Cria a conexão
$conn = new mysqli ($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM tb_ficha";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// Loop para exibir as fichas encontradas
while ($row = $result->fetch_assoc()) {
    echo "ID: " . $row["id_ficha"] . "<br>";
    echo "Nome: " . $row["nome"] . "<br>";
    echo "Dia: " . $row["dia"] . "<br>";
    echo "Código do Usuário: " . $row["cod_usuario"] . "<br>";
    echo "Código do Profissional: " . $row["cod_profissional"] . "<br>";
    echo "<hr>"; // Linha divisória entre as fichas
}
} else {
echo "Nenhuma ficha encontrada na tabela.";
}
$conn->close();

