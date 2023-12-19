
<?php
require '../Model/conexao.php';
$result = null; // Inicializando a variável $result como nula

if (isset($_GET['search'])) {
    $data = $_GET['search'];

    // Preparando a consulta SQL usando um prepared statement
    $sql = "SELECT * FROM tb_usuario WHERE id_usuario LIKE ? OR nome LIKE ? OR email LIKE ? ORDER BY id_usuario DESC"; // Use 'id_usuario' se for o nome correto da coluna
    $stmt = mysqli_stmt_init($conexao);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Adicionando caracteres curinga '%' para permitir correspondências parciais
        $param = "%$data%";
        
        // Associando os parâmetros e executando a consulta
        mysqli_stmt_bind_param($stmt, "sss", $param, $param, $param);
        mysqli_stmt_execute($stmt);
        
        // Obtendo o resultado da consulta
        $result = mysqli_stmt_get_result($stmt);
    }
} else {
    $sql = "SELECT * FROM tb_usuario ORDER BY id_usuario DESC";
    $result = mysqli_query($conexao, $sql); // Executando a consulta SQL
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/personal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body >
    <div class="container">
        <div class="topo">
        <button class="voltar" onclick="window.location.href = '../View/login.html'">Sair</button>
            <center><img class="me-3" src="../assets/logo sem bg.png" alt=""  height="200"></center> 
            <div class="lh-1">
                <h1 class="h6 mb-0 text-white lh-1"></h1>
                <small></small>
      </div>
            
        </div>
        <div class="topo2">
            <form action="EnviaFicha.php" method="get">
            
                <br>
                <div class="box-search">
               <input type="search" class="form-control" placeholder="Pesquisar" id="pesquisar"> 
                    <button onclick="searchData()" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg> 
                    </button>
                </div>
            
            
            <table class="table text-white table-bg w-70">
                <thead>
                    <tr>
                        <th scope="col">COD</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Email</th>
                        <th scope="col">Selecionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($user_data = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>".$user_data['id_usuario']."</td>";
                            echo "<td>".$user_data['nome']."</td>";
                            echo "<td>".$user_data['sexo']."</td>";
                            echo "<td>".$user_data['email']."</td>";
                            echo "<td><input type='checkbox' name='id_usuario[]' value='" . $user_data['id_usuario'] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhum resultado encontrado.</td></tr>";
                    }
                    
                    ?>
                </tbody>
            </table>
        </div>

    <div class="m-5">

    </div>

    <div class="topo2">
        <!-- Fichas de Treino na div topo2 -->
        <div class="exercise-card">
            <h3>Peito e Triceps A</h3>
            <select name="dia_semana[]" onchange="vinculaDia(this.value, 0)">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Supino reto:</strong> 3 séries de 10 repetições</p>
            <p><strong>Peck deck:</strong> 3 séries de 12 repetições</p>
            <p><strong>Supino enclinado:</strong> 3 séries de 12 repetições</p>
            <p><strong>Triceps pulley corda:</strong> 3 séries de 12 repetições</p>
            <p><strong>Triceps testa:</strong> 3 séries de 12 repetições</p>
        
        </div>
        <div class="exercise-card">
            <h3>Peito e Triceps B</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Flexões:</strong> 3 séries de 15 repetições</p>
            <p><strong>Supino enclinado:</strong> 3 séries de 10 repetições</p>
            <p><strong>Crossover:</strong> 3 séries de 12 repetições</p>
            <p><strong>Triceps francês:</strong> 3 séries de 12 repetições</p>
            <p><strong>Triceps pulley barra:</strong> 3 séries de 12 repetições</p>


        </div>

        <div class="exercise-card">
            <h3>Quadriceps A</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Agachamento:</strong> 3 séries de 12 repetições</p>
            <p><strong>Cadeira extensora:</strong> 3 séries de 12 repetições</p>
            <p><strong>Leg press:</strong> 3 séries de 10 repetições</p>
            <p><strong>Panturrilha sentado:</strong> 3 séries de 12 repetições</p>
            <p><strong>Panturrilha em pé:</strong> 3 séries de 12 repetições</p>
        
        </div>
        <div class="exercise-card">
            <h3>Quadriceps B</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Cadeira extensora:</strong> 3 séries de 12 repetições</p>
            <p><strong>Leg press:</strong> 3 séries de 12 repetições</p>
            <p><strong>Bulgaro:</strong> 3 séries de 12 repetições</p>
            <p><strong>Panturrilha sentado:</strong> 3 séries de 12 repetições</p>
            <p><strong>Panturrilha em pé:</strong> 3 séries de 12 repetições</p>

        </div>
        <!-- ... Adicionar as outras 10 fichas de treino aqui ... -->
    </div>
    <div class="topo2">
        <!-- Fichas de Treino na div topo2 -->
        <div class="exercise-card">
            <h3>Costas e biceps A</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p>Puxada alta: 3 séries de 12 repetições</p>
            <p>Remada baixa: 3 séries de 10 repetições</p>
            <p>Remada cavalinho: 3 séries de 12 repetições</p>
            <p>Rosca scott: 3 séries de 12 repetições</p>
            <p>Rosca martelo: 3 séries de 12 repetições</p>
        </div>
        <div class="exercise-card">
            <h3>Costas e biceps B</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Remada baixa:</strong> 3 séries de 12 repetições</p>
            <p><strong>Barra fixa:</strong> 3 séries de 10 repetições</p>
            <p><strong>Puldown:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca scott maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca direta:</strong> 3 séries de 12 repetições</p>

        </div>

        <div class="exercise-card">
            <h3>Ombros A</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Elevação lateral maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Elevação frontal halter:</strong> 3 séries de 12 repetições</p>
            <p><strong>Desenvolvimento frontal maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Crucifixo inverso unilateral:</strong> 3 séries de 12 repetições</p>

        </div>
        <div class="exercise-card">
            <h3>Ombros B</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Elevação lateral halter:</strong> 3 séries de 12 repetições</p>
            <p><strong>Elevação frontal halter:</strong> 3 séries de 12 repetições</p>
            <p><strong>Desenvolvimento frontal maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Crucifixo inverso maquina:</strong> 3 séries de 12 repetições</p>

        </div>
        <!-- ... Adicionar as outras 10 fichas de treino aqui ... -->
    </div>
    <div class="topo2">
        <!-- Fichas de Treino na div topo2 -->
        <div class="exercise-card">
            <h3>Braço completo A</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Triceps pulley corda:</strong> 3 séries de 10 repetições</p>
            <p><strong>Triceps francês halter:</strong> 3 séries de 10 repetições</p>
            <p><strong>Triceps testa maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca scott maquina:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca direta:</strong> 3 séries de 12 repetições</p>

        </div>
        <div class="exercise-card">
            <h3>Braço completo B</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Triceps pulley triângulo:</strong> 3 séries de 10 repetições</p>
            <p><strong>Triceps francês maquina:</strong> 3 séries de 10 repetições</p>
            <p><strong>Triceps testa halter:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca scott:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca martelo:</strong> 3 séries de 12 repetições</p>

        </div>

        <div class="exercise-card">
            <h3>Upper body</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Supino enclinado:</strong> 3 séries de 10 repetições</p>
            <p><strong>Puxada alta:</strong> 3 séries de 12 repetições</p>
            <p><strong>Desenvolvimento com halteres:</strong> 3 séries de 12 repetições</p>
            <p><strong>Triceps francês:</strong> 3 séries de 12 repetições</p>
            <p><strong>Rosca martelo:</strong> 3 séries de 12 repetições</p>

        </div>
        <div class="exercise-card">
            <h3>Full body</h3>
            <select name="dia_semana[]">
                <option value="-1">Selecione</option>
                <option value="1">Segunda-feira</option>
                <option value="2">Terça-feira</option>
                <option value="3">Quarta-feira</option>
                <option value="4">Quinta-feira</option>
                <option value="5">Sexta-feira</option>
                <option value="6">Sábado</option>
                <option value="7">Domingo</option>
            </select>
            <p><strong>Exercícios:</strong></p>
            <p><strong>Supino enclinado:</strong> 3 séries de 10 repetições</p>
            <p><strong>Agachamento:</strong> 3 séries de 12 repetições</p>
            <p><strong>Mesa flexora:</strong> 3 séries de 12 repetições</p>
            <p><strong>Elevação pélvica:</strong> 3 séries de 12 repetições</p>
            <p><strong>Cadeira flexora:</strong> 3 séries de 12 repetições</p>

            </div>
        </div>
        <strong><input type="submit" name="Associar" value="Associar"></strong>
        </form>
    </div>

    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Impede o comportamento padrão de enviar formulário
                searchData();
            }
        });

        function searchData() {
            event.preventDefault()
            window.location = 'ficha.php?search='+search.value;
        }

        var DiasDaSemana = Array(12);

        function vinculaDia(codDiaDaSemana, numeroDaFicha){

            for(i = 0; i < DiasDaSemana.length; i++){
                if(DiasDaSemana[i] == codDiaDaSemana){
                    alert("Dia da semana já selecionado na ficha " + i);
                    return;
                }
            }

            DiasDaSemana[numeroDaFicha] = codDiaDaSemana;
        }
    </script>
</body>
</html>
