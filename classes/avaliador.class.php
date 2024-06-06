<?php
    include_once('conexao.class.php');
class Avaliador
{
    private $vch_avaliador;
    private $vch_cpf_avaliador;

    public function setVchAvaliador($vch_avaliador)
    {
        $this->vch_avaliador = $vch_avaliador;
    }

    public function getVchAvaliador()
    {
        return $this->vch_avaliador;
    }

    public function setVchCpfAvaliador($vch_cpf_avaliador)
    {
        $this->vch_cpf_avaliador = $vch_cpf_avaliador;
    }

    public function getVchCpfAvaliador()
    {
        return $this->vch_cpf_avaliador;
    }

    public function exibirAvaliadores()
    {
        $pdo = Database::conexao();
        $sql = "SELECT da.*, u.vch_login
        FROM ciptea.dados_avaliador AS da
        INNER JOIN ciptea.usuario AS u
        ON da.cod_usuario = u.cod_usuario";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        return $consulta;
    }
}



?>
