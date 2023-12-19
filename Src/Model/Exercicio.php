<?php
class Exercicio {

    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public int $id;
    public string $nome;
    public string $linkDoVideo;
    public int $qtdeSeries;
    public string $reps;

    public function getExercicio (){
        $query = "select * from tb_treino";
        
        
    }
}



