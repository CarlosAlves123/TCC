<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class CarregaF {
    private Environment $ambiente;
    private FilesystemLoader $carregador;

    public function __construct() {
        // Carregando o Twig
        $this->carregador = new FilesystemLoader(__DIR__ . '/../View');
        $this->ambiente = new Environment($this->carregador);
    }
    public function buscaFichas() {
        
        ///////////// MUDEI AQUI /////////////////////
        require_once __DIR__ . '/../Model/conexao.php';


        $conexao = new mysqli($servidor, $usuario, $senha, $banco);

        if ($conexao->connect_error) {
            die("Erro na conexão: " . $conexao->connect_error);
        }

        $sqlFichas = "SELECT * FROM tb_ficha_usuario";
        $resultFichas = $conexao->query($sqlFichas);

        $fichas = [];

        if ($resultFichas->num_rows > 0) {
            while ($ficha = $resultFichas->fetch_assoc()) {
                $sqlExercicios = "SELECT * FROM tb_exercicio WHERE cod_ficha = " . $ficha['cod_ficha'];
                $resultExercicios = $conexao->query($sqlExercicios);

                $exercicios = [];

                if ($resultExercicios->num_rows > 0) {
                    while ($exercicio = $resultExercicios->fetch_assoc()) {
                        $exercicios[] = $exercicio;
                    }
                }

                $ficha['exercicios'] = $exercicios;
                $fichas[] = $ficha;
            }
        }
       

        return $fichas;
    }

    public function renderizaFichas() {
        $informacoes['fichas'] = $this->buscaFichas();
        echo $this->ambiente->render('index.html', $informacoes);
    
    }
    
}


$carregador = new CarregaF();
$carregador->renderizaFichas();

