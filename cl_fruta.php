<?php
class contato 
{
    private $id; 
    private $nome;
    private $cor; 

    function __construct($v_id, $v_nome, $v_cor)
    {
        $this->id=$v_id; 
        $this->nome=$v_nome;
        $this->cor=$v_cor;
    }

    public function getId(){ return $this->id; }
    public function getNome(){ return $this->nome; } 
    public function getCor(){ return $this->cor; }

    PUBLIC FUNCTION setId ($v_id)
    {
        $this->id=$v_id;
    }

    PUBLIC FUNCTION setNome ($v_email)
    {
        $this->nome=$v_nome;
    }

    PUBLIC FUNCTION setCor ($v_nome)
    {
        $this->cor=$v_cor;
    }
}
?>